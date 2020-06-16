<template>
  <v-container>
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">IMAGENS</span>
      </v-flex>
    </v-layout>
    <v-divider color="grey" />
    <v-card-title>
      <v-btn
        @click.stop="modalLocal = !modalLocal"
        class="mt-10"
        color="#FF3D00"
        light
      >
        NOVA IMAGEM
      </v-btn>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Pesquisar"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-dialog
      v-model="modalLocal"
      max-width="800px"
      no-click-animation
      persistent
    >
      <!--Inicio modal de editar-->
      <v-card>
        <v-card-title>
          <span class="headline">{{ formTitle() }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap column>
              <v-flex xs12 sm6 md4>
                <v-form ref="form" v-model="validation">
                  <v-text-field
                    v-model="editedItem.titulo"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Nome"
                  />
                  <v-text-field
                    v-model="editedItem.descricao"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Descrição"
                  />
                  <v-text-field
                    v-model="imagemNome"
                    @click="$refs.imginput.click()"
                    label="Imagem para o serviço"
                    solo
                    readonly
                  />
                  <input
                    id="imgcard"
                    ref="imginput"
                    @change="imagemEscolhida"
                    type="file"
                    accept="image/*"
                    style="display: none;"
                  />
                </v-form>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn @click="close" color="#FF3D00" text>
            Cancelar
          </v-btn>
          <v-btn @click="reset" color="#FF3D00" text>
            Reiniciar
          </v-btn>
          <v-btn @click="onSubmit" color="#FF3D00" text>
            Salvar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-layout class="mt-4">
      <v-flex>
        <v-data-table
          :headers="headers"
          :items="imagensInfo"
          :search="search"
          class="elevation-3"
        >
          <template v-slot:item.action="{ item }">
            <v-icon
              @click="dialogEdit(item)"
              medium
              class="mr-2"
              color="primary"
            >
              mdi-circle-edit-outline
            </v-icon>
            <v-icon @click="deletaImagem(item)" medium color="error">
              mdi-delete
            </v-icon>
          </template>
        </v-data-table>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  layout: 'dashboard',
  data() {
    return {
      search: '',
      imagemNome: '',
      modalLocal: false,
      validation: true,
      editedIndex: -1,
      headers: [
        {
          text: 'Nome',
          align: 'left',
          sortable: true,
          value: 'nome'
        },
        { text: 'Descrição', sortable: true, value: 'descricao' },
        { text: 'id', sortable: true, value: 'id' },
        { text: '', value: 'action', sortable: false }
      ],
      imagens: [],
      editedItem: {
        id: 0,
        titulo: '',
        descricao: '',
        imagem: {}
      },
      defaultItem: {
        id: 0,
        titulo: '',
        descricao: '',
        imagem: {}
      }
    }
  },
  computed: {
    imagensInfo() {
      return this.imagens.map((e) => ({
        id: e.id,
        nome: e.titulo,
        descricao: e.descricao,
        imagem: e.imagem,
        imagemNome: e.imagem
      }))
    },
    onSignup() {
      return this.editedIndex === -1
    }
  },

  asyncData(context) {
    return context.app.$axios
      .get('/todasImagem')
      .then((res) => ({ imagens: res.data.dados }))
  },
  methods: {
    imagemEscolhida(e) {
      const imagem = e.target.files
      if (imagem[0] !== undefined) {
        // exibe nome da imagem selecionada
        this.imagemNome = imagem[0].name
        if (this.imagemNome.lastIndexOf('.') <= 0) {
          return
        }
        ;[this.editedItem.imagem] = imagem
      } else {
        // this.imagemNome = '';
        this.editedItem.imagem = ''
      }
    },
    formTitle() {
      return this.editedIndex === -1 ? 'NOVA IMAGEM' : 'EDITAR IMAGEM'
    },
    onSubmit() {
      if (!this.validation) {
        this.$refs.form.validate()
        return
      }
      if (this.onSignup) {
        this.novaImagem()
      } else {
        this.atualizaImagem()
      }
      this.close()
    },
    reset() {
      this.$refs.form.reset()
    },
    close() {
      this.modalLocal = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },
    // novaImagem() {
    //   const Imagem = {
    //     id: this.editedItem.id,
    //     titulo: this.editedItem.titulo,
    //     descricao: this.editedItem.descricao,
    //     imagem: this.editedItem.imagem
    //   }
    //   this.$axios
    //     .$post('novaImagem', Imagem)
    //     .then((res) => {
    //       this.imagens.push(res.data.dados)
    //     })
    //     .catch(({ response }) => {
    //       console.log(response)
    //       window.alert('Campo Inválido')
    //     })
    // },
    novaImagem() {
      const localData = new FormData()
      localData.append('titulo', this.editedItem.titulo)
      localData.append('descricao', this.editedItem.descricao)
      if (this.editedItem.imagem) {
        localData.append('imagem', this.editedItem.imagem)
      }
      this.$axios
        .post('/novaImagem', localData)
        .then((res) => {
          window.alert('Imagem criada com sucesso', { duration: 5000 })
          console.log(res)
          this.refresh()
        })
        .catch(({ response }) => {
          console.log(response)
          window.alert('Campo Inválido')
        })
      this.close()
    },
    // atualizaImagem() {
    //   const editImagem = {
    //     id: this.editedItem.id,
    //     titulo: this.editedItem.titulo,
    //     descricao: this.editedItem.descricao,
    //     imagem: this.editedItem.imagem
    //   }
    //   this.$axios
    //     .$post('mudaImagem', editImagem)
    //     .then((res) => {
    //       this.imagens = this.imagens.map((e) => {
    //         if (e.id === this.editedItem.id) {
    //           return Object.assign(e, editImagem)
    //         }
    //         return e
    //       })
    //     })
    //     .catch(({ response }) => {
    //       window.alert('Erro ao editar imagem')
    //     })
    //   window.location.reload()
    // },
    atualizaImagem() {
      const editableLocalData = new FormData()
      editableLocalData.append('id', this.editedItem.id)
      editableLocalData.append('titulo', this.editedItem.titulo)
      editableLocalData.append('descricao', this.editedItem.descricao)
      if (this.editedItem.imagem) {
        editableLocalData.append('imagem', this.editedItem.imagem)
      }
      this.$axios
        .post('mudaImagem', editableLocalData)
        .then((res) => {
          window.alert(res.data.mensagem, { duration: 5000 })
          this.imagens = this.imagens.map((e) => {
            if (e.id === this.editedItem.id) {
              return Object.assign(e, editableLocalData)
            }
            this.refresh()
            return e
          })
        })
        .catch(({ response }) => {
          console.log(response)
          window.alert('Campo Inválido')
        })
      this.close()
    },
    dialogEdit(item) {
      this.modalLocal = true
      this.editedIndex = item.id
      this.editedItem = Object.assign({}, item)
      this.editedItem.descricao = ''
    },
    deletaImagem(item) {
      const ok = window.confirm(
        'Você tem certeza de que deseja excluir essa imagem?'
      )
      if (ok) {
        this.$axios
          .post('apagaImagem', {
            id: item.id
          })
          .then((res) => {
            this.imagens = this.imagens.filter((e) => e.id !== item.id)
          })
          .catch(({ response }) => {
            window.alert('Erro ao deletar imagem')
          })
      }
      window.location.reload()
    },

    refresh() {
      this.$axios
        .get('/imagens')
        .then((res) => {
          this.imagens = res.data.dados
        })
        .catch(() => ({}))
    }
  }
}
</script>

<style></style>
