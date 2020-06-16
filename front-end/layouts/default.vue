<template>
  <v-app>
    <div>
      <v-app-bar color="#2d6760" height="80px" flat fixed>
        <v-spacer></v-spacer>

        <span id="Title">Amoeba</span>

        <v-spacer></v-spacer>
        <v-spacer></v-spacer>
        <v-app-bar-nav-icon
          id="Navigation"
          @click="drawer = !drawer"
          class="hidden-lg-and-up"
        >
        </v-app-bar-nav-icon>

        <v-btn
          depressed
          color="#2d6760"
          class="hidden-md-and-down Item text-capitalize"
          ><a href="#Banner">Home</a></v-btn
        >
        <v-btn
          depressed
          color="#2d6760"
          class="hidden-md-and-down Item text-capitalize"
          ><a href="#AboutUs">About Us</a></v-btn
        >

        <v-btn
          depressed
          color="#2d6760"
          class="hidden-md-and-down Item text-capitalize"
          ><a href="#Serviços">Services</a></v-btn
        >

        <v-btn
          depressed
          color="#2d6760"
          class="hidden-md-and-down Item text-capitalize"
          ><a href="#Portifolio">Portifolio</a></v-btn
        >

        <v-btn
          depressed
          color="#2d6760"
          class="hidden-md-and-down Item text-capitalize"
          ><a href="#Equipe">Team</a></v-btn
        >

        <div depressed class="hidden-md-and-down boto" color="#2d6760">
          <v-menu offset-y>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                color="#2d6760"
                depressed
                class="hidden-md-and-down text-capitalize botoes"
              >
                Drop Down <v-icon>mdi-chevron-down</v-icon>
              </v-btn>
            </template>
            <v-list class="listin" light>
              <v-list-item v-for="(drops, index) in drops" :key="index">
                <a class="droplista">
                  <v-list-item-title>{{ drops.title }}</v-list-item-title>
                </a>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>

        <v-btn
          depressed
          color="#2d6760"
          class="hidden-md-and-down Item text-capitalize"
          ><a href="#ContactUs">Contact Us</a></v-btn
        >

        <v-spacer></v-spacer>
      </v-app-bar>
      <v-navigation-drawer v-model="drawer" color="#01292a" app>
        <v-list dense>
          <v-list-item-group color="white">
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title class="ItemDrawer"
                  ><a href="#Banner">Home</a></v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title class="ItemDrawer"
                  ><a href="#AboutUs">About Us</a></v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title class="ItemDrawer"
                  ><a href="#Serviços">Services</a></v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title class="ItemDrawer"
                  ><a href="#Portifolio">Portifolio</a></v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title class="ItemDrawer">team</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-group no-action>
              <template v-slot:activator>
                <v-list-item style="padding: 0px;">
                  <v-list-item-content>
                    <v-list-item-title class="ItemDrawer"
                      >Drop Down</v-list-item-title
                    >
                  </v-list-item-content>
                </v-list-item>
              </template>

              <v-list-item v-for="i in dropItems" :key="i" link>
                <v-list-item-content>
                  <v-list-item-title class="nav-icons ItemDrawer">{{
                    i
                  }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-group>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title class="ItemDrawer"
                  ><a href="#ContactUs">Contact Us</a></v-list-item-title
                >
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-navigation-drawer>
    </div>
    <nuxt />
  </v-app>
</template>

<script>
export default {
  components: {},
  data: () => {
    return {
      drawer: false,
      drops: [
        {
          title: 'Drop Down 1'
        },
        {
          title: 'Drop Down 2'
        },
        {
          title: 'Drop Down 3'
        },
        {
          title: 'Drop Down 4'
        },
        {
          title: 'Drop Down 5'
        }
      ],
      dropItems: [
        'Drop Down 1',
        'Drop Down 2',
        'Drop Down 3',
        'Drop Down 4',
        'Drop Down 5'
      ]
    }
  }
}
</script>

<style scoped>
#teste {
  width: 360px;
}

#Title {
  font-size: 30px;
  font-family: 'Lato', sans-serif;
}

#Title a {
  text-decoration: none;
  color: white;
}

#Navigation {
  font-size: 2rem;
  cursor: pointer;
}

.Item {
  font-size: 13px;
  font-family: 'Open Sans', sans-serif;
}

.boto {
  padding: 0;
  margin: 0;
  border-radius: 0%;
}

.botoes {
  font-size: 12px;
  font-family: 'Open Sans', sans-serif;
  border-radius: 0%;
}

.Item a {
  text-decoration: none;
  color: white;
}

.ItemDrawer {
  color: #9cd5ce;
  font-weight: 500;
  font-family: 'Open Sans', sans-serif;
}

.ItemDrawer a {
  color: #9cd5ce;
  text-decoration: none;
}

#listin {
  color: #fff;
}

.droplista {
  color: #2d6760;
}

.droplista:hover {
  color: #70b9b0;
}

.boto {
  background-color: #fff;
}

.nav-icons {
  display: block;
  position: relative;
  color: #d2ece9;
  padding: 0px 15px;
  transition: 0.3s;
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
}
</style>
