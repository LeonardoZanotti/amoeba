<template>
  <div>
    <v-container id="ServiçosCard" fluid>
      <div id="Total">
        <div id="TotalCard">
          <v-card id="CARD">
            <v-container>
              <div>
                <v-img :src="path + url" contain max-height="45"></v-img>
              </div>
              <div class="d-flex justify-center">
                <span id="titulo"
                  ><a href="#">{{ servico }}</a></span
                >
              </div>
              <v-col
                class="d-flex justify-center"
                justify="center"
                align="center"
                style="height: 100%"
              >
                <span id="Descrição">{{ descricao }}</span>
              </v-col>
            </v-container>
          </v-card>
        </div>
      </div>
    </v-container>
  </div>
</template>
<script>
export default {
  props: {
    id: {
      type: Number,
      required: true
    },
    imgId: {
      type: Number,
      required: true
    },
    url: {
      type: String,
      required: true
    },
    servico: {
      type: String,
      required: true
    },
    descricao: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      path: 'http://localhost:8000/storage/'
    }
  }
}
</script>
<style scoped>
#ServiçosCard {
  padding: 0;
  margin: 0;
  background-color: #f2f9f8;
  display: flex;
  justify-content: center;
  width: 100%;
}
#TotalCard {
  padding: 0;
  margin: 0;
  display: flex;
  justify-content: center;
  height: 257px;
  width: 380px;
}

#CARD {
  height: 257px;
  width: 380px;
  background-color: #f2f9f8;
  border: none;
  box-shadow: none;
}

#titulo {
  color: #343a40;
  margin-bottom: 10px;
  font-size: 18px;
  text-transform: uppercase;
  font-family: 'lato', sans-serif;
  font-weight: 700;
  padding-top: 10px;
}

#titulo a:hover {
  color: #70b9b0;
  transition: 0.5s;
}

#titulo a {
  color: #343a40;
  text-decoration: none;
}

#Descrição {
  line-height: 24px;
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
  color: #777;
}
</style>
