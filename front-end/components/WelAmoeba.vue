<template>
  <div id="Banner">
    <div id="ImgFundo" fluid>
      <div id="OverFlow">
        <v-row id="OVALL" justify="center" align="center" style="height: 100%">
          <span id="OFTitle">Welcome to Amoeba</span>
          <span id="OFDescripiton">
            We are team of talanted designers making websites with Bootstrap
          </span>
          <button id="OVStarted"><a href="#AboutUs"> Get Started</a></button>
        </v-row>
      </div>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style scoped>
#ImgFundo {
  background-color: lightgray;
  background-image: url('/imagens/img/hero-background.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
  height: 600px;
}

#OverFlow {
  background-color: rgba(106, 170, 167, 0.7);
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 600px;
}

#OVALL {
  display: flex;
  flex-direction: column;
}

#OFTitle {
  font-size: 48px;
  font-family: 'Lato', sans-serif;
}

#OFDescripiton {
  font-size: 20px;
  font-family: 'Lato', sans-serif;
}

#OVStarted {
  color: #fff;
  border: 1px solid #fff;
  font-family: 'Lato', sans-serif;
  font-weight: 400;
  font-size: 16px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 8px 28px 10px 28px;
  border-radius: 50px;
  margin-top: 60px;
  transition: 0.5s;
}

#OVStarted a {
  text-decoration: none;
  color: white;
}

#OVStarted a:hover {
  color: #70b9b0;
}

#OVStarted:hover {
  background: #fff;
  color: #70b9b0;
  border: 1px solid #70b9b0;
}

@media screen and (max-width: 670px) {
  #OFTitle {
    font-size: 40px;
  }

  #OFDescripiton {
    font-size: 15px;
  }
}

@media screen and (max-width: 450px) {
  #OFTitle {
    font-size: 35px;
  }

  #OFDescripiton {
    font-size: 12px;
  }
}
</style>
