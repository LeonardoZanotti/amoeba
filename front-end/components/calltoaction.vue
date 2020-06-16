<template>
  <div id="ImgFundo" fluid>
    <v-col
      id="OverFlowCALL"
      xl="12"
      lg="12"
      md="12"
      sm="12"
      xs="12"
      justify="center"
      align="center"
      style="height: 100%"
    >
      <v-row id="CALL" justify="center" align="center" style="height: 100%">
        <span id="CALLTitle">Call To Action</span>
        <span id="CALLDescripiton">
          Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
          dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est
          laborum.
        </span>
        <button id="CALLStarted"><a href="#"> Call To Action</a></button>
      </v-row>
    </v-col>
  </div>
</template>

<script>
export default {}
</script>

<style scoped>
#ImgFundo {
  background-color: lightgray;
  background-image: url('/imagens/img/call-to-action-bg.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
  height: 250px;
}

#OverFlowCALL {
  background-color: rgba(1, 41, 42, 0.5);
  top: 0;
  left: 0;
  width: 100%;
  height: 250px;
}

#CALL {
  display: flex;
  flex-direction: column;
}

#CALLTitle {
  color: #fff;
  font-size: 28px;
  font-weight: 700;
  font-family: 'Lato', sans-serif;
}

#CALLDescripiton {
  color: #fff;
  font-size: 20px;
  font-family: 'Open Sans', sans-serif;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  padding-bottom: 20px;
}

#CALLStarted {
  font-family: 'Lato', sans-serif;
  font-weight: 400;
  font-size: 16px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 8px 28px;
  border-radius: 25px;
  transition: 0.5s;
  margin-top: 10px;
  border: 2px solid #fff;
  color: #fff;
  transition: 0.5s;
}

#CALLStarted a {
  text-decoration: none;
  color: white;
}

#CALLStarted:hover {
  background-color: #70b9b0;
}

@media screen and (max-width: 410px) {
  #CALLDescripiton {
    padding-bottom: 0px;
    font-size: 15px;
  }
}
</style>
