# Use an official Node.js runtime as the base image
FROM node:18

# Set the working directory in the container
WORKDIR /app

# Copy the package.json file to the container
COPY package.json .

# Install the dependencies
RUN npm install

# Copy the rest of the app files to the container
COPY . .

# Expose the port that the app runs on
EXPOSE 5173

# Specify the command to run when the container starts
CMD [ "npm", "run", "dev" ]
