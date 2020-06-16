<template>
  <v-container class="white--text">
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">CATEGORIAS</span>
      </v-flex>
    </v-layout>
    <v-divider color="grey" />
    <v-card-title>
      <v-btn
        @click.stop="modalLocal = !modalLocal"
        class="mt-10"
        color="#43A047"
        light
      >
        NOVA CATEGORIA
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
      <v-card class="bacano">
        <v-card-title>
          <span class="headline">{{ formTitle() }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap column>
              <v-flex xs12 sm6 md4>
                <v-form ref="form" v-model="validation">
                  <v-text-field
                    v-model="editedItem.categoria"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Categoria"
                  />
                </v-form>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn @click="close" color="#43A047" text>
            Cancelar
          </v-btn>
          <v-btn @click="reset" color="#43A047" text>
            Reiniciar
          </v-btn>
          <v-btn @click="onSubmit" color="#43A047" text>
            Salvar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-layout class="mt-4">
      <v-flex>
        <v-data-table
          :headers="headers"
          :items="categoriasInfo"
          :search="search"
          class="elevation-3 bacano"
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
            <v-icon @click="deletaCategoria(item)" medium color="error">
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
          text: 'Categorias',
          align: 'left',
          value: 'categoria'
        },
        { text: '', value: 'action', sortable: false }
      ],
      categorias: [],
      editedItem: {
        id: 0,
        categoria: ''
      },
      defaultItem: {
        id: 0,
        categoria: ''
      }
    }
  },

  computed: {
    // funcao MAP JS, serve para pegar elementos específicos da API
    categoriasInfo() {
      return this.categorias.map((c) => ({
        id: c.id,
        categoria: c.categoria
      }))
    },
    onSignup() {
      return this.editedIndex === -1
    }
  },
  asyncData(context) {
    return context.app.$axios
      .get('/todasCategoria')
      .then((res) => ({ categorias: res.data.dados }))
  },
  methods: {
    formTitle() {
      return this.editedIndex === -1 ? 'NOVO CATEGORIA' : 'EDITAR CATEGORIA'
    },
    onSubmit() {
      if (!this.validation) {
        this.$refs.form.validate()
        return
      }
      if (this.onSignup) {
        this.novaCategoria()
      } else {
        this.atualizaCategoria()
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
    novaCategoria() {
      const CategoriaData = {
        id: this.editedItem.id,
        categoria: this.editedItem.categoria
      }
      this.$axios
        .$post('novaCategoria', CategoriaData)
        .then((res) => {
          this.categorias.push(res.dados)
        })
        .catch(({ response }) => {
          window.alert('Campo Inválido')
        })
    },
    atualizaCategoria() {
      const editableCategoriaData = {
        id: this.editedItem.id,
        categoria: this.editedItem.categoria
      }
      this.$axios
        .$post('mudaCategoria', editableCategoriaData)
        .then((res) => {
          this.categorias = this.categorias.map((e) => {
            if (e.id === this.editedItem.id) {
              return Object.assign(e, editableCategoriaData)
            }
            return e
          })
        })
        .catch(({ response }) => {
          window.alert('Erro ao editar categoria')
        })
      window.location.reload()
    },
    dialogEdit(item) {
      this.modalLocal = true
      this.editedIndex = item.id
      this.editedItem = Object.assign({}, item)
    },
    deletaCategoria(item) {
      const ok = window.confirm(
        'Você tem certeza de que deseja excluir essa categoria?'
      )
      if (ok) {
        this.$axios
          .post('apagaCategoria', {
            id: item.id
          })
          .then((res) => {
            this.categorias = this.categorias.filter((e) => e.id !== item.id)
          })
          .catch(({ response }) => {
            window.alert('Erro ao deletar categoria')
          })
      }
      window.location.reload()
    }
  }
}
</script>

<style lang="stylus" scoped>
.bacano {
  background-color: #00695C;
}
</style>
