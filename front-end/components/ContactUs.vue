<template>
  <v-container id="ContactUs" fluid>
    <v-row id="TitleTotal">
      <v-col
        justify="center"
        align="center"
        style="height: 100%"
        xl="10"
        lg="10"
        md="10"
        sm="10"
        xs="10"
        cols="10"
      >
        <span id="Title">Contact Us</span>
      </v-col>
      <v-col
        justify="center"
        align="center"
        style="height: 100%"
        xl="10"
        lg="10"
        md="10"
        sm="10"
        xs="10"
        cols="10"
      >
        <span id="Descri"
          >Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex
          aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos
          quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
          fugiat sit in iste officiis commodi quidem hic quas.</span
        >
      </v-col>
    </v-row>
    <v-container
      id="ContactUs2"
      fluid
      justify="start"
      align="start"
      style="height: 100%"
    >
      <v-row id="SecCont" justify="center" align="center" style="height: 100%">
        <v-col
          justify="center"
          align="start"
          style="height: 100%"
          xl="3"
          lg="5"
          md="5"
          sm="10"
          xs="10"
          class="Alinha"
          cols="10"
        >
          <span id="ContTitle"> Amoeba</span>
          <span class="ContDescri"
            >Cras fermentum odio eu feugiat. Justo eget magna fermentum iaculis
            eu non diam phasellus. Scelerisque felis imperdiet proin fermentum
            leo. Amet volutpat consequat mauris nunc congue.</span
          >
          <div>
            <button class="ContactMedia">
              <v-icon class="ContactMediaIcon">mdi-twitter</v-icon>
            </button>
            <button class="ContactMedia">
              <v-icon class="ContactMediaIcon">mdi-facebook</v-icon>
            </button>
            <button class="ContactMedia">
              <v-icon class="ContactMediaIcon">mdi-instagram</v-icon>
            </button>
            <button class="ContactMedia">
              <v-icon class="ContactMediaIcon">mdi-linkedin</v-icon>
            </button>
          </div>
        </v-col>
        <v-col
          id="Contact-2"
          justify="center"
          align="start"
          style="height: 100%"
          xl="3"
          lg="5"
          md="5"
          sm="10"
          xs="10"
          cols="10"
        >
          <div class="Espaçamento">
            <v-icon class="Contat2Icon"> mdi-map-marker</v-icon>
            <span class="Contact2">A108 Adam Street New York, NY 535022</span>
          </div>
          <div class="Espaçamento">
            <v-icon class="Contat2Icon"> mdi-email</v-icon>
            <span class="Contact2">info@example.com</span>
          </div>
          <div>
            <v-icon class="Contat2Icon"> mdi-cellphone-android</v-icon>
            <span class="Contact2">+1 5589 55488 55s</span>
          </div>
        </v-col>
        <v-col
          xl="3"
          lg="10"
          md="10"
          sm="10"
          xs="10"
          justify="center"
          align="center"
          style="height: 100%"
          class="engloba-form0"
          cols="10"
        >
          <div class="engloba-form">
            <v-form ref="form" v-model="valid">
              <v-text-field
                v-model="name"
                :rules="nameRules"
                label="Your Name"
                class="form-input"
                required
                color="#2d6760"
                light
              />
              <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                class="form-input"
                required
                color="#2d6760"
                light
              />
              <v-text-field
                v-model="assunto"
                :rules="assuntoRules"
                label="Subject"
                class="form-input"
                required
                color="#2d6760"
                light
              />
              <v-textarea
                v-model="message"
                :rules="mensagemRules"
                label="Mensagem"
                class="form-input"
                placeholder="Message"
                color="#2d6760"
                light
              />

              <v-btn
                @click="
                  enviarForm()
                  enviarEmail()
                "
                class="btn text-capitalize"
                round="round"
                depressed="depressed"
              >
                <span id="Send">
                  Send Message
                </span>
              </v-btn>
            </v-form>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>
<script>
export default {
  data: () => ({
    nome: '',
    assunto: '',
    assuntoRules: [(v) => !!v || 'Campo obrigatório'],
    valid: false,
    nameRules: [(v) => !!v || 'Campo obrigatório'],
    email: '',
    emailRules: [
      (v) => !!v || 'Campo obrigatório',
      (v) => /.+@.+/.test(v) || 'Email inválido'
    ],
    message: '',
    mensagemRules: [
      (v) => !!v || 'Campo obrigatório',
      (v) => (v && v.length > 5) || 'Mensagem muito curta'
    ]
  }),
  methods: {
    enviarForm() {
      this.$axios
        .post('/novaMensagem', {
          assunto: this.assunto,
          nome: this.nome,
          email: this.email,
          mensagem: this.message
        })
        .then(() => {
          this.$refs.form.reset()
          window.scrollTo(0, 0)
        })
        .catch(({ response }) => {
          const { mensagem, errosSecundarios: erros } = response.data
          const listaErros = erros
            ? `\n ${Object.values(erros).join('\n')}`
            : ''
          this.$toast.error(`${mensagem}${listaErros}`, { duration: 5000 })
        })
    }
  }
}
</script>
<style scoped>
#ContactUs {
  padding: 0;
  margin: 0;
}
#ContactUs2 {
  padding: 0;
  margin: 0;
}
#TitleTotal {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f2f9f8;
  padding-top: 50px;
  flex-direction: column;
  position: static;
}

#Title {
  font-size: 32px;
  font-weight: 300;
  margin-bottom: 20px;
  padding-bottom: 0;
  color: #555;
  font-family: 'Lato', sans-serif;
}

#Descri {
  padding-bottom: 10px;
  font-family: 'Open Sans', sans-serif;
  color: #777;
  font-size: 1rem;
}

#SecCont {
  background-color: #f2f9f8;
  display: flex;
  align-items: flex-start !important;
}

#ContTitle {
  font-size: 36px;
  margin: 0 0 10px 0;
  padding: 0;
  line-height: 1;
  font-weight: 400;
  letter-spacing: 1px;
  color: #70b9b0;
}

.ContDescri {
  font-size: 14px;
  line-height: 24px;
  font-family: 'Lato', sans-serif;
  color: #888;
  padding: 0;
}
.Alinha {
  display: flex;
  flex-direction: column;
  position: relative;
}

.ContactMedia {
  border-radius: 50%;
  border-style: solid;
  border-color: #70b9b0;
  border-width: 1px;
  width: 35px;
  height: 35px;
  background-color: #fff;
  margin-left: 3px;
  margin-top: 15px;
}

.ContactMedia:hover {
  border-color: #fff;
  background-color: #70b9b0;
  transition: 0.4s ease-in-out;
}

.ContactMediaIcon {
  color: #70b9b0;
}

.ContactMediaIcon:hover {
  color: #fff;
  transition: 0.4s ease-in-out;
}

#Contact-2 {
  display: flex;
  justify-content: start;
  align-items: flex-start;
  flex-direction: column;
}

.Contat2Icon {
  color: #70b9b0;
  font-size: 2rem;
}

.Contact2 {
  padding-left: 3px;
  line-height: 28px;
  font-size: 14px;
  color: #777;
  font-family: 'Open Sans', sans-serif;
}

.Espaçamento {
  padding-bottom: 23px;
}

.form-input {
  padding: 10px 10px 0 0;
  color: black;
}
.v-menu__content {
  z-index: 2 !important;
}
.v-menu__content {
  z-index: 2 !important;
}
.theme--light {
  z-index: 2 !important;
}
.menuable__content__active {
  z-index: 2 !important;
}

.btn {
  border-radius: 0% !important;
  width: 155px;
  height: 44px !important;
  background-color: #70b9b0 !important;
  border: 0;
  padding: 10px 24px;
  color: #fff;
  transition: 0.4s;
}

.btn:hover {
  background-color: #92cac3;
}

#Send {
  font-family: 'Open Sans', sans-serif;
}

@media screen and (max-width: 1901px) {
  .Alinha {
    max-height: 150px;
  }

  #Contact-2 {
    max-height: 150px;
  }
}

@media screen and (max-width: 959px) {
  .engloba-form0 {
    max-height: 800px;
  }
  .Alinha {
    display: flex;
    align-items: center !important;
    justify-content: center !important;
  }
  .ContDescri {
    display: flex;
    align-items: center !important;
    justify-content: center;
  }
  #Contact-2 {
    display: flex;
    align-items: center !important;
  }
}

@media screen and (max-width: 640px) {
  .Alinha {
    max-height: 150px;
  }

  #Contact-2 {
    max-height: 150px;
  }
}

@media screen and (max-width: 460px) {
  #ContTitle {
    padding-top: 15px;
    font-size: 30px;
  }
  #Contact-2 {
    padding-top: 30px;
  }
  .Contact2 {
    font-size: 12px;
  }
}
</style>
