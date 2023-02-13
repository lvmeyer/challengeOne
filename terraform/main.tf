terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 4.16"
    }
  }
  required_version = ">= 1.2.0"
}

provider "aws" {
  region = var.region
}

resource "aws_instance" "app_challenge_one" {
  ami                  = var.ami_id
  instance_type        = "t2.micro"
  key_name             = var.ami_key_pair_name
  iam_instance_profile = var.iam_instance_profile
  security_groups      = ["${aws_security_group.ingress-all-test.id}"]

  tags = {
    Name = var.instance_name
  }

	user_data = file("script.sh")

  subnet_id = aws_subnet.subnet-uno.id

}

resource "aws_ecs_cluster" "challenge-one-cluster" {
  name = var.cluster_name
}