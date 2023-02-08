<template>
    <div>
        <h1 class="titleProduct">To load the products click the button</h1>
    </div>
    <button class="buttonLoad" @click="getAlert"><span>Load Products</span></button>
</template>


<script setup lang="ts">
const emits = defineEmits(["pressed"]);


function getAlert() {
    emits("pressed");
}

</script>


<style lang="css">
.titleProduct {
  text-align: center;
  font-family: 'Lato', sans-serif;
  font-weight: 500;
  margin-bottom: 1em;
}


.buttonLoad {
  width: 130px;
  height: 40px;
  color: #fff;
  border-radius: 5px;
  padding: 10px 25px;
  font-family: 'Lato', sans-serif;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  display: inline-block;
  box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
   7px 7px 20px 0px rgba(0,0,0,.1),
   4px 4px 5px 0px rgba(0,0,0,.1);
  outline: none;
  background: linear-gradient(0deg, rgba(255,151,0,1) 0%, rgba(251,75,2,1) 100%);
  width: 130px;
  height: 40px;
  line-height: 42px;
  padding: 0;
  border: none;
  margin: auto;
  display: flex;
  text-align: center;
  margin-bottom: 2em;
}
.buttonLoad span {
  position: relative;
  display: block;
  width: 100%;
  height: 100%;
}
.buttonLoad:before,
.buttonLoad:after {
  position: absolute;
  content: "";
  right: 0;
  top: 0;
  background: rgba(251,75,2,1);
  transition: all 0.3s ease;
}
.buttonLoad:before {
  height: 0%;
  width: 2px;
}
.buttonLoad:after {
  width: 0%;
  height: 2px;
}
.buttonLoad:hover{
   background: transparent;
  box-shadow: none;
}
.buttonLoad:hover:before {
  height: 100%;
}
.buttonLoad:hover:after {
  width: 100%;
}
.buttonLoad span:hover{
   color: rgba(251,75,2,1);
}
.buttonLoad span:before,
.buttonLoad span:after {
  position: absolute;
  content: "";
  left: 0;
  bottom: 0;
   background: rgba(251,75,2,1);
  transition: all 0.3s ease;
}
.buttonLoad span:before {
  width: 2px;
  height: 0%;
}
.buttonLoad span:after {
  width: 0%;
  height: 2px;
}
.buttonLoad span:hover:before {
  height: 100%;
}
.buttonLoad span:hover:after {
  width: 100%;
}


</style>
