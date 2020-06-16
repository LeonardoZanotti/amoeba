<template>
  <v-container id="Total" @scroll="onScroll" fluid>
    <v-col height="110">
      <v-col id="Footer" justify="center" align="center" style="height: 100%">
        <span id="footerUp">© Copyright Amoeba. All Rights Reserved </span>
        <span id="footerDown"
          >Designed by
          <a id="links" href="https://ecomp.co/" target="_blank"
            >Ecomp S2</a
          ></span
        >
      </v-col>
    </v-col>
    <button :class="{ desaparece: some }" class="back-to-top">
      <a href="#Banner"><v-icon>mdi-menu-up</v-icon></a>
    </button>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      active: false,
      some: true
    }
  },
  mounted() {
    window.addEventListener('scroll', this.onScroll)
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.onScroll)
  },
  methods: {
    onScroll() {
      if (window.scrollY > 0) {
        this.some = false
      } else if (window.scrollY === 0) {
        this.some = true
      }
    }
  }
}
</script>

<style scoped>
#Total {
  background-color: #073839;
}
#Footer {
  display: flex;
  flex-direction: column;
}
#footerUp {
  color: #fff;
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
}
#footerDown {
  padding-top: 10px;
  font-size: 13px;
  color: #fff;
  font-family: 'Open Sans', sans-serif;
}
#links {
  text-decoration: none;
  color: #7dc88e;
}

#links:hover {
  color: #00d3b8;
}

.back-to-top {
  position: fixed;
  width: 40px;
  height: 40px;
  border-radius: 3px;
  right: 15px;
  bottom: 15px;
  background-color: #70b9b0;
  color: #fff;
}

.back-to-top a {
  color: #fff;
}
.back-to-top:hover {
  color: #fff;
  background: #8bc6bf;
  transition: 0.2s ease-in-out;
}
.desaparece {
  display: none;
}
</style>
