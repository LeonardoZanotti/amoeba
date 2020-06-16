<template>
  <v-container id="Portifolio" fluid>
    <v-row id="Total" justify="center" align="center">
      <v-row justify="center" align="center">
        <span id="Title">Our Portfolio</span>
      </v-row>
      <v-row justify="center" align="center">
        <v-col justify="center" align="center">
          <button
            :class="{ TrocaCor: isActive1 }"
            @click="
              ;(isActive1 = !isActive1),
                (isActive2 = false),
                (isActive3 = false),
                (isActive4 = false),
                (portState = 'ALL'),
                filtraPort()
            "
            class="Filter"
          >
            ALL
          </button>
          <button
            :class="{ TrocaCor: isActive2 }"
            @click="
              ;(isActive2 = !isActive2),
                (isActive1 = false),
                (isActive3 = false),
                (isActive4 = false),
                (portState = 'APP'),
                filtraPort()
            "
            class="Filter"
          >
            APP
          </button>
          <button
            :class="{ TrocaCor: isActive3 }"
            @click="
              ;(isActive3 = !isActive3),
                (isActive1 = false),
                (isActive2 = false),
                (isActive4 = false),
                (portState = 'CARD'),
                filtraPort()
            "
            class="Filter"
            data-filter=""
          >
            CARD
          </button>
          <button
            :class="{ TrocaCor: isActive4 }"
            @click="
              ;(isActive4 = !isActive4),
                (isActive1 = false),
                (isActive2 = false),
                (isActive3 = false),
                (portState = 'WEB'),
                filtraPort()
            "
            class="Filter"
          >
            WEB
          </button>
        </v-col>
      </v-row>
    </v-row>
    <v-row>
      <v-row justify="center" align="center" style="height: 100%">
        <v-col
          v-for="port in portFiltered"
          :key="port"
          xl="4"
          lg="4"
          md="6"
          sm="11"
          xs="11"
          justify="center"
          align="center"
          style="height: 100%"
        >
          <PortItens
            :id="port.id"
            :imagemid="port.imagem_id"
            :img-url="port.imagem.caminho"
            :link="port.link"
            :categoria="port.categorias"
            :titulo="port.imagem.descricao"
          ></PortItens>
        </v-col>
      </v-row>
    </v-row>
  </v-container>
</template>
<script>
import PortItens from '../components/PortItens'
export default {
  components: {
    PortItens
  },

  props: {
    portifolios: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  data() {
    return {
      path: 'http://localhost:8000/storage/',
      isActive1: true,
      isActive2: false,
      isActive3: false,
      isActive4: false,
      portState: 'ALL',
      portFiltered: []
    }
  },

  mounted() {
    this.filtraPort()
  },
  methods: {
    filtraPort() {
      return (this.portFiltered = this.portifolios.filter(
        (value) =>
          value.categorias[0].categoria === this.portState ||
          value.categorias[1].categoria === this.portState
      ))
    }
  }
}
</script>
<style scoped>
#Portifolio {
  background-color: white;
  padding: 0;
  margin: 0;
  padding-top: 40px;
  /* height: 1200px; */
}

#Total {
  display: flex;
  flex-direction: column;
}

#Title {
  font-size: 32px;
  font-weight: 300;
  margin-bottom: 20px;
  color: #555;
  font-family: 'Lato', sans-serif;
  padding-bottom: 10px;
}

.Filter {
  cursor: pointer;
  margin: 0 15px 15px 0;
  margin-bottom: 15px;
  display: inline-block;
  padding: 10px 20px;
  font-size: 12px;
  font-family: 'Open Sans', sans-serif;
  line-height: 20px;
  color: #777;
  border-radius: 4px;
  text-transform: uppercase;
  background: white;
  margin-bottom: 5px;
  transition: all 0.3s ease-in-out;
}

.Filter:hover {
  background-color: #70b9b0;
  color: #fff;
}

.TrocaCor {
  background-color: #70b9b0;
  color: #fff;
}

@media screen and (max-width: 1264px) {
  #Portifolio {
    height: 1800px;
  }
}
@media screen and (max-width: 960px) {
  #Portifolio {
    height: 3030px;
  }
}

@media screen and (max-width: 460px) {
  #Portifolio {
    height: 2250px;
  }
}
</style>
