<template>
  <v-container id="Serviços" fluid>
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
      >
        <span id="Title">Services</span>
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
      >
        <span id="Descri"
          >Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex
          aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos
          quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
          fugiat sit in iste officiis commodi quidem hic quas.</span
        >
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {}
</script>
<style scoped>
#Serviços {
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
</style>
