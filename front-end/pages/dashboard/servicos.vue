<template>
  <v-container>
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">SERVIÇOS</span>
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
        NOVO SERVIÇO
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
                    label="titulo"
                  />
                  <v-text-field
                    v-model="editedItem.descricao"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Descrição"
                  />
                  <v-select
                    v-model="editedItem.imagem_id"
                    :items="imagensInfo"
                    item-text="nome"
                    item-value="id"
                    label="Imagem ID"
                  >
                  </v-select>
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
          :items="servicosInfo"
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
            <v-icon @click="deletaServico(item)" medium color="error">
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
      modalLocal: false,
      validation: true,
      editedIndex: -1,
      headers: [
        {
          text: 'Serviço',
          align: 'left',
          sortable: true,
          value: 'titulo'
        },
        { text: 'Descrição', sortable: true, value: 'descricao' },
        { text: 'Imagem', sortable: true, value: 'imagem_id' },
        { text: '', value: 'action', sortable: false }
      ],
      servicos: [],
      imagens: [],
      editedItem: {
        id: 0,
        titulo: '',
        descricao: '',
        imagem_id: ''
      },
      defaultItem: {
        id: 0,
        titulo: '',
        descricao: '',
        imagem_id: ''
      }
    }
  },
  computed: {
    servicosInfo() {
      return this.servicos.map((e) => ({
        id: e.id,
        titulo: e.titulo,
        descricao: e.descricao,
        imagem_id: e.imagem_id
      }))
    },
    imagensInfo() {
      return this.imagens.map((e) => ({
        id: e.id,
        nome: e.titulo,
        descricao: e.descricao
      }))
    },
    onSignup() {
      return this.editedIndex === -1
    }
  },
  async asyncData({ $axios }) {
    const [servicosRes, imagensRes] = await Promise.all([
      $axios.get('/todosServico'),
      $axios.get('/todasImagem')
    ])
    return {
      servicos: servicosRes.data.dados,
      imagens: imagensRes.data.dados
    }
  },
  methods: {
    formTitle() {
      return this.editedIndex === -1 ? 'NOVO SERVIÇO' : 'EDITAR SERVIÇO'
    },
    onSubmit() {
      if (!this.validation) {
        this.$refs.form.validate()
        return
      }
      if (this.onSignup) {
        this.novoServico()
      } else {
        this.atualizaServico()
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
    novoServico() {
      const Servico = {
        id: this.editedItem.id,
        titulo: this.editedItem.titulo,
        descricao: this.editedItem.descricao,
        imagem_id: this.editedItem.imagem_id
      }
      this.$axios
        .$post('novoServico', Servico)
        .then((res) => {
          this.servicos.push(res.dados)
        })
        .catch(({ response }) => {
          window.alert('Campo Inválido')
        })
    },
    atualizaServico() {
      const editServico = {
        id: this.editedItem.id,
        titulo: this.editedItem.titulo,
        descricao: this.editedItem.descricao,
        imagem_id: this.editedItem.imagem_id
      }
      this.$axios
        .$post('mudaServico', editServico)
        .then((res) => {
          this.servicos = this.servicos.map((e) => {
            if (e.id === this.editedItem.id) {
              return Object.assign(e, editServico)
            }
            return e
          })
        })
        .catch(({ response }) => {
          window.alert('Erro ao editar serviço')
        })
      window.location.reload()
    },
    dialogEdit(item) {
      this.modalLocal = true
      this.editedIndex = item.id
      this.editedItem = Object.assign({}, item)
    },
    deletaServico(item) {
      const ok = window.confirm(
        'Você tem certeza de que deseja excluir esse serviço?'
      )
      if (ok) {
        this.$axios
          .post('apagaServico', {
            id: item.id
          })
          .then((res) => {
            this.servicos = this.servicos.filter((e) => e.id !== item.id)
          })
          .catch(({ response }) => {
            window.alert('Erro ao deletar serviço')
          })
      }
      window.location.reload()
    }
  }
}
</script>

<style></style>
