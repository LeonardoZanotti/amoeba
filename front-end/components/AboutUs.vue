<template>
  <v-container id="AboutUs" fluid>
    <section id="Posi">
      <span id="Title">About Us</span>
    </section>
    <v-row id="Total">
      <v-col id="LeftSide" xl="5" lg="5" md="11" sm="11" xs="11">
        <span id="o1"
          >Voluptatem dignissimos provident quasi corporis voluptates sit
          assumenda.</span
        >
        <span id="o2"
          >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </span>
        <div class="Alinhamento">
          <v-icon>mdi-checkbox-multiple-marked-circle-outline color</v-icon>
          <span id="o3"
            >Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span
          >
        </div>

        <div class="Alinhamento">
          <v-icon>mdi-checkbox-multiple-marked-circle-outline color</v-icon>
          <span id="o3"
            >Duis aute irure dolor in reprehenderit in voluptate velit.</span
          >
        </div>
        <div class="Alinhamento">
          <v-icon>mdi-checkbox-multiple-marked-circle-outline color</v-icon>
          <span id="o3"
            >Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
            irure dolor in reprehenderit in voluptate trideta storacalaperda
            mastiro dolore eu fugiat nulla pariatur.</span
          >
        </div>
        <span id="o4"
          >Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
          irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
          fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
          sunt in culpa qui officia deserunt mollit anim id est laborum
        </span>
      </v-col>

      <v-col id="RightSide" xl="5" lg="5" md="11" sm="11" xs="11"> </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {}
</script>

<style scoped>
#AboutUs {
  padding: 0;
}
#Total {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: white;
  padding: 0;
  padding-bottom: 50px;
}

#Posi {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: white;
  padding-top: 50px;
  padding-bottom: 30px;
}
#Title {
  font-size: 32px;
  font-weight: 300;
  margin-bottom: 20px;
  padding-bottom: 0;
  color: #555;
  font-family: 'Lato', sans-serif;
}
#LeftSide {
  display: flex;
  flex-direction: column;
}

#o1 {
  font-size: 26px;
  font-weight: 400;
  font-family: 'Lato', sans-serif;
  color: #777;
}

#o2 {
  font-style: italic !important;
  color: #777;
  padding-bottom: 18px;
}

#o3 {
  padding-bottom: 10px;
  font-family: 'Open Sans', sans-serif;
  color: #777;
  font-size: 1rem;
}

#o4 {
  padding-bottom: 10px;
  padding-top: 25px;
  font-family: 'Open Sans', sans-serif;
  color: #777;
  font-size: 1rem;
}

.Alinhamento {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}

.color {
  font-size: 20px;
  padding-right: 4px;
  color: #70b9b0;
}

#RightSide {
  height: 440px;
  width: 405px;
  background-image: url('/imagens/img/about-img.jpg');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
@media screen and (max-width: 599px) {
  #Total {
    flex-direction: column;
    height: 800px;
  }
  #o1 {
    font-size: 20px;
  }

  #o2 {
    padding-bottom: 13px;
  }

  #o3 {
    padding-bottom: 7px;
  }

  #o4 {
    padding-bottom: 7px;
  }
  #RightSide {
    height: 300px;
    width: 500px;
  }

  #LeftSide {
    padding-left: 20px;
  }
}

@media screen and (max-width: 480px) {
  #Total {
    flex-direction: column;
    height: 1000px;
  }
}
</style>
