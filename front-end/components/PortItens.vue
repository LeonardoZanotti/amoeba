<template>
  <v-container id="TOTAL" fluid>
    <v-row>
      <v-img
        id="imgFundo"
        :src="path + imgUrl"
        @mouseover=";(appear = true), (hover = true)"
        @mouseleave=";(appear = false), (hover = false)"
        contain
        max-height="280"
        justify="center"
        align="center"
        style="height: 100%"
        ><v-row
          id="aaa"
          v-if="appear"
          :class="{ backhover: hover }"
          justify="center"
          align="center"
          style="height: 100%"
        >
          <span id="titulo">{{ titulo }}</span>
          <a :href="link" target="_blank"
            ><v-icon id="plus">mdi-plus</v-icon></a
          >
        </v-row>
      </v-img>
    </v-row>
  </v-container>
</template>
<script>
export default {
  props: {
    id: {
      type: Number,
      required: true
    },
    imagemid: {
      type: Number,
      required: true
    },
    imgUrl: {
      type: String,
      required: true
    },
    link: {
      type: String,
      required: true
    },
    categoria: {
      type: String,
      required: true
    },
    titulo: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      path: 'http://localhost:8000/storage/',
      appear: false,
      hover: false
    }
  }
}
</script>
<style scoped>
#TOTAL {
  width: 380px;
  height: 290px;
}
#imgFundo {
  max-width: 350px;
  height: 220px;
  padding: 0;
  margin: 0;
  vertical-align: middle;
  border-radius: 2%;
}
#imgFundo:hover {
  transform: scale(1.1);
  transition: all 0.3s ease-in-out;
  border-style: none;
}

.backhover {
  background-color: rgba(1, 41, 42, 0.5);
  position: absolute;
  top: 0;
  left: 0;
  width: 380px;
  height: 220px;
}

#plus {
  color: #70b9b0;
  font-size: 2em;
  font-family: IcoFont !important;
}

#aaa {
  display: flex;
  flex-direction: column;
  transition: 4s;
}

#titulo {
  color: #fff;
  font-weight: bold;
  font-size: 22px;
  font-family: 'Lato', sans-serif;
}

#titulo a {
  color: #fff;
  text-decoration: none;
}
@media screen and (max-width: 460px) {
  #TOTAL {
    width: 280px;
    height: 200px;
  }
  #imgFundo {
    max-width: 280px;
    height: 200px;
  }
  .backhover {
    width: 280px;
    height: 200px;
    left: 4.2%;
  }
}
</style>
