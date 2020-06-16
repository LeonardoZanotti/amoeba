<template>
  <v-container id="ajustes" fluid>
    <v-card id="totalMember" elevaition>
      <v-col id="member" align="center" justify="center">
        <v-img id="photo" :src="path + url" />
        <span id="name">{{ nome }}</span>
        <span id="prof">{{ cargo }}</span>
        <span id="descri">{{ descricao }}</span>
        <div id="totalIcons">
          <a :href="twitterUrl" target="_blanc"
            ><v-icon class="icon"> mdi-twitter </v-icon></a
          >
          <a :href="facebookUrl" target="_blanc"
            ><v-icon class="icon"> mdi-facebook </v-icon></a
          >
          <a :href="instagramUrl" target="_blanc"
            ><v-icon class="icon"> mdi-instagram </v-icon></a
          >
          <a :href="linkedinUrl" target="_blanc"
            ><v-icon class="icon"> mdi-linkedin </v-icon></a
          >
        </div>
      </v-col>
    </v-card>
  </v-container>
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
    nome: {
      type: String,
      required: true
    },
    cargo: {
      type: String,
      required: true
    },
    descricao: {
      type: String,
      required: true
    },
    twitterUrl: {
      type: String,
      required: true
    },
    facebookUrl: {
      type: String,
      required: true
    },
    instagramUrl: {
      type: String,
      required: true
    },
    linkedinUrl: {
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
#ajustes {
  background-color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
}
#totalMember {
  width: 330px;
  height: 419px;
  background-color: #ffffff;
}
#member {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
#photo {
  border-radius: 50%;
  width: 174px;
  max-height: 174px;
  margin: 0px 0px 30px;
  margin-top: 10px;
}
#name {
  font-weight: 700;
  color: #777;
  margin-bottom: 2px;
  font-size: 18px;
  font-family: 'Lato', sans-serif;
}
#prof {
  font-style: italic;
  font-size: 13px;
  text-align: center;
  font-family: 'Open Sans', sans-serif;
  color: #777;
}
#descri {
  padding-top: 10px;
  font-size: 14px;
  font-style: italic;
  color: #aaaaaa;
  font-family: 'Open Sans', sans-serif;
}
#totalIcons {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  padding-top: 10px;
}
.icon {
  color: #3c8b81;
  opacity: 0.5;
}
.icon:hover {
  opacity: 1;
}
</style>
