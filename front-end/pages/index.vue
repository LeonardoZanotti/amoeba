<template>
  <v-app>
    <WelAmoeba />
    <AboutUs />
    <ServicosTitle />
    <v-container class="ajustes" fluid>
      <v-row justify="center" align="center" style="height: 100%">
        <v-col
          v-for="colNum in Servicos"
          :key="colNum"
          xl="4"
          lg="4"
          md="6"
          sm="11"
          xs="11"
        >
          <servicos
            :id="colNum.id"
            :img-id="colNum.imagem_id"
            :descricao="colNum.descricao"
            :servico="colNum.titulo"
            :url="colNum.imagem.caminho"
          ></servicos>
        </v-col>
      </v-row>
    </v-container>
    <CallToAction />
    <v-container fluid class="ajustes">
      <v-row>
        <PortHeader :portifolios="Portifolio" />
      </v-row>
    </v-container>
    <FAQ />
    <timeTitle />
    <v-container class="ajustes1" fluid>
      <v-row justify="center" align="center" style="height: 100%">
        <v-col
          v-for="equip in Equipes"
          :key="equip"
          xl="3"
          lg="3"
          md="6"
          sm="11"
          xs="11"
        >
          <timeItem
            :id="equip.id"
            :img-id="equip.imagem_id"
            :url="equip.imagem.caminho"
            :nome="equip.nome"
            :cargo="equip.cargo"
            :descricao="equip.descricao"
            :twitter-url="equip.twitter"
            :facebook-url="equip.facebook"
            :instagram-url="equip.instagram"
            :linkedin-url="equip.linkedin"
          ></timeItem>
        </v-col>
      </v-row>
    </v-container>
    <ContactUs />
    <!-- <Mapa /> -->
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191:0x49f75d3281df052a!2s150 Park Row, New York, NY 10007, USA!5e0!3m2!1sen!2sbg!4v1579767901424!5m2!1sen!2sbg"
      style="border:0;"
      allowfullscreen=""
      frameborder="0"
      width="100%"
      height="380px"
    ></iframe>
    <Footer />
  </v-app>
</template>
<script>
import WelAmoeba from '../components/WelAmoeba'
import AboutUs from '../components/AboutUs'
import servicos from '../components/servicos'
import ServicosTitle from '../components/ServicosTitle'
import CallToAction from '../components/calltoaction'
import PortHeader from '../components/PortHeader'
import Footer from '../components/Footer'
// import Mapa from '../components/Mapa'
import ContactUs from '../components/ContactUs'
import FAQ from '../components/FAQ'
import timeTitle from '../components/timeTitle'
import timeItem from '../components/timeItem'

export default {
  components: {
    WelAmoeba,
    AboutUs,
    servicos,
    ServicosTitle,
    CallToAction,
    PortHeader,
    Footer,
    // Mapa,
    ContactUs,
    FAQ,
    timeTitle,
    timeItem
  },
  data() {
    return {}
  },
  async asyncData({ $axios }) {
    const [
      servicoRes,
      imagemRes,
      portifolioRes,
      categoriaRes,
      equipeRes
    ] = await Promise.all([
      $axios.get('/todosServico'),
      $axios.get('/todasImagem'),
      $axios.get('/todosPortfolio'),
      $axios.get('/todasCategoria'),
      $axios.get('/todasEquipe')
    ])
    return {
      Servicos: servicoRes.data.dados,
      Imagens: imagemRes.data.dados,
      Portifolio: portifolioRes.data.dados,
      Categoria: categoriaRes.data.dados,
      Equipes: equipeRes.data.dados
    }
  }
}
</script>
<style scoped>
.ajustes {
  padding: 0;
  background-color: #f2f9f8;
}

.ajustes1 {
  padding: 0;
  background-color: #fff;
}

#back {
  background-color: #fff;
}
</style>
