<template>
  <v-container class="white--text">
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">CONTATO</span>
      </v-flex>
    </v-layout>
    <v-divider color="grey" />
    <v-card-title>
      <v-spacer></v-spacer>
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
          <span class="headline">EDITAR CONTATO</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap column>
              <v-flex xs12 sm6 md4>
                <v-form ref="form" v-model="validation">
                  <v-text-field
                    v-model="editedItem.endereco"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Endereço"
                  />
                  <v-text-field
                    v-model="editedItem.email"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Email"
                  />
                  <v-text-field
                    v-model="editedItem.telefone"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Telefone"
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
          :items="contatosInfo"
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
      headers: [
        { text: 'Endereço', value: 'endereco' },
        { text: 'Email', align: 'left', value: 'email', sortable: false },
        { text: 'Telefone', value: 'telefone', sortable: false },
        { text: '', value: 'action', sortable: false }
      ],
      contatos: [],
      editedItem: {
        endereco: '',
        email: '',
        telefone: ''
      },
      defaultItem: {
        endereco: '',
        email: '',
        telefone: ''
      }
    }
  },

  computed: {
    // funcao MAP JS, serve para pegar elementos específicos da API
    contatosInfo() {
      return this.contatos.map((c) => ({
        id: c.id,
        endereco: c.endereco,
        email: c.email,
        telefone: c.telefone
      }))
    }
  },
  asyncData(context) {
    return context.app.$axios
      .get('/todosContato')
      .then((res) => ({ contatos: res.data.dados }))
  },
  methods: {
    onSubmit() {
      if (!this.validation) {
        this.$refs.form.validate()
        return
      }
      this.atualizaContato()
      this.close()
    },
    reset() {
      this.$refs.form.reset()
    },
    close() {
      this.modalLocal = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
      }, 300)
    },
    atualizaContato() {
      const editableContatoData = {
        id: this.editedItem.id,
        endereco: this.editedItem.endereco,
        email: this.editedItem.email,
        telefone: this.editedItem.telefone
      }
      this.$axios
        .$post('mudaContato', editableContatoData)
        .then((res) => {
          this.contatos = this.contatos.map((e) => {
            if (e.id === this.editedItem.id) {
              return Object.assign(e, editableContatoData)
            }
            return e
          })
        })
        .catch(({ response }) => {
          window.alert('Erro ao editar contato')
        })
      window.location.reload()
    },
    dialogEdit(item) {
      this.modalLocal = true
      this.editedItem = Object.assign({}, item)
    }
  }
}
</script>

<style lang="stylus" scoped>
.bacano {
  background-color: #00695C;
}
</style>
