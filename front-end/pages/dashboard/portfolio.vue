<template>
  <v-container class="white--text">
    <v-layout>
      <v-flex>
        <span class="font-weight-thin display-2">PORTFÓLIO</span>
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
        NOVO ITEM
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
          <span class="headline">NOVO ITEM</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap column>
              <v-flex xs12 sm6 md4>
                <v-form ref="form" v-model="validation">
                  <v-select
                    v-model="editedItem.categoria_id[0]"
                    :items="categoriasInfo"
                    item-text="categoria"
                    item-value="id"
                    label="Categoria"
                  >
                  </v-select>
                  <v-text-field
                    v-model="editedItem.link"
                    :rules="[(v) => !!v || 'Campo Obrigatório']"
                    color="cyan darken-2"
                    label="Link"
                  />
                  <v-select
                    v-model="editedItem.imagem_id"
                    :items="imagensInfo"
                    item-text="nome"
                    item-value="id"
                    label="Imagem"
                  >
                  </v-select>
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
          :items="portfoliosInfo"
          :search="search"
          class="elevation-3 bacano"
        >
          <template v-slot:item.categoria="{ item }">
            {{ nomeCategoria(item) }}
          </template>
          <template v-slot:item.nome="{ item }">
            {{ compare(item) }}
          </template>
          <template v-slot:item.action="{ item }">
            <v-icon @click="deletaPortfolio(item)" medium color="error">
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
      headers: [
        { text: 'Categoria', value: 'categoria' },
        { text: 'Link', align: 'left', value: 'link', sortable: false },
        { text: 'Imagens', value: 'nome', sortable: false },
        { text: '', value: 'action', sortable: false }
      ],
      portfolios: [],
      imagens: [],
      categorias: [],
      editedItem: {
        id: 0,
        categoria_id: [],
        link: '',
        imagem_id: ''
      },
      defaultItem: {
        id: 0,
        categoria_id: [],
        link: '',
        imagem_id: ''
      }
    }
  },

  computed: {
    // funcao MAP JS, serve para pegar elementos específicos da API
    portfoliosInfo() {
      return this.portfolios.map((c) => ({
        id: c.id,
        categoria_id: c.categorias[0].id,
        link: c.link,
        imagem_id: c.imagem_id
      }))
    },
    imagensInfo() {
      return this.imagens.map((c) => ({
        id: c.id,
        nome: c.titulo,
        descricao: c.descricao
      }))
    },
    categoriasInfo() {
      return this.categorias.map((c) => ({
        id: c.id,
        categoria: c.categoria
      }))
    }
  },
  async asyncData({ $axios }) {
    const [portfoliosRes, imagensRes, categoriasRes] = await Promise.all([
      $axios.get('/todosPortfolio'),
      $axios.get('/todasImagem'),
      $axios.get('/todasCategoria')
    ])
    return {
      portfolios: portfoliosRes.data.dados,
      imagens: imagensRes.data.dados,
      categorias: categoriasRes.data.dados
    }
  },
  methods: {
    compare(item) {
      const x = item.imagem_id
      return this.imagens[x - 1].nome
    },
    nomeCategoria(item) {
      const x = item.categoria_id
      return this.categorias[x - 1].categoria
    },
    onSubmit() {
      if (!this.validation) {
        this.$refs.form.validate()
        return
      }
      this.novoPortfolio()
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
    novoPortfolio() {
      //  váriavel com todos os dados dos serviços
      const PortfolioData = {
        imagem_id: this.editedItem.imagem_id,
        link: this.editedItem.link,
        categoria_id: this.editedItem.categoria_id
      }
      this.$axios
        .$post('novoPortfolio', PortfolioData)
        .then((res) => {
          this.portfolios.push(res.dados)
        })
        .catch(({ response }) => {
          window.alert('Campo Inválido')
        })
      window.location.reload()
    },
    deletaPortfolio(item) {
      const ok = window.confirm(
        'Você tem certeza de que deseja excluir esse portfólio?'
      )
      if (ok) {
        this.$axios
          .post('apagaPortfolio', {
            id: item.id
          })
          .then((res) => {
            this.portfolios = this.portfolios.filter((e) => e.id !== item.id)
          })
          .catch(({ response }) => {
            window.alert('Erro ao deletar portfólio')
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
