<template>
  <v-container id="FAQ" fluid>
    <div id="FAQTotal">
      <v-row
        id="ajustes"
        justify="center"
        align="center"
        xl="10"
        lg="10"
        md="10"
        sm="10"
        xs="10"
      >
        <v-col
          justify="center"
          align="center"
          xl="10"
          lg="10"
          md="10"
          sm="10"
          xs="10"
        >
          <span id="FAQTitle">Frequent Asked Questions</span>
        </v-col>

        <v-col xl="10" lg="10" md="10" sm="10" xs="10" cols="10">
          <div>
            <v-expansion-panels id="ExpansionPanelsTotal" accordion flat>
              <v-expansion-panel class="PainelTotal">
                <v-expansion-panel-header
                  :class="{ ManterCor: manter1 }"
                  @click="
                    ;(manter1 = !manter1),
                      (manter2 = false),
                      (manter3 = false),
                      (manter4 = false),
                      (manter5 = false),
                      (manter6 = false)
                  "
                  class="PainelTitulos"
                  color="#555"
                  >Non consectetur a erat nam at lectus urna
                  duis?</v-expansion-panel-header
                >
                <v-expansion-panel-content class="PainelDescricao">
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id
                  volutpat lacus laoreet non curabitur gravida. Venenatis lectus
                  magna fringilla urna porttitor rhoncus dolor purus non.
                </v-expansion-panel-content> </v-expansion-panel
              ><v-expansion-panel class="PainelTotal">
                <v-expansion-panel-header
                  :class="{ ManterCor: manter2 }"
                  @click="
                    ;(manter2 = !manter2),
                      (manter1 = false),
                      (manter3 = false),
                      (manter4 = false),
                      (manter5 = false),
                      (manter6 = false)
                  "
                  class="PainelTitulos"
                  >Feugiat scelerisque varius morbi enim nunc faucibus a
                  pellentesque?
                </v-expansion-panel-header>
                <v-expansion-panel-content class="PainelDescricao">
                  Dolor sit amet consectetur adipiscing elit pellentesque
                  habitant morbi. Id interdum velit laoreet id donec ultrices.
                  Fringilla phasellus faucibus scelerisque eleifend donec
                  pretium. Est pellentesque elit ullamcorper dignissim. Mauris
                  ultrices eros in cursus turpis massa tincidunt dui.
                </v-expansion-panel-content> </v-expansion-panel
              ><v-expansion-panel class="PainelTotal">
                <v-expansion-panel-header
                  :class="{ ManterCor: manter3 }"
                  @click="
                    ;(manter3 = !manter3),
                      (manter2 = false),
                      (manter1 = false),
                      (manter4 = false),
                      (manter5 = false),
                      (manter6 = false)
                  "
                  class="PainelTitulos"
                  >Dolor sit amet consectetur adipiscing elit pellentesque
                  habitant morbi?</v-expansion-panel-header
                >
                <v-expansion-panel-content class="PainelDescricao">
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices
                  sagittis orci. Faucibus pulvinar elementum integer enim. Sem
                  nulla pharetra diam sit amet nisl suscipit. Rutrum tellus
                  pellentesque eu tincidunt. Lectus urna duis convallis
                  convallis tellus. Urna molestie at elementum eu facilisis sed
                  odio morbi quis
                </v-expansion-panel-content> </v-expansion-panel
              ><v-expansion-panel class="PainelTotal">
                <v-expansion-panel-header
                  :class="{ ManterCor: manter4 }"
                  @click="
                    ;(manter4 = !manter4),
                      (manter2 = false),
                      (manter3 = false),
                      (manter1 = false),
                      (manter5 = false),
                      (manter6 = false)
                  "
                  class="PainelTitulos"
                  >Ac odio tempor orci dapibus. Aliquam eleifend mi in
                  nulla?</v-expansion-panel-header
                >
                <v-expansion-panel-content class="PainelDescricao">
                  Dolor sit amet consectetur adipiscing elit pellentesque
                  habitant morbi. Id interdum velit laoreet id donec ultrices.
                  Fringilla phasellus faucibus scelerisque eleifend donec
                  pretium. Est pellentesque elit ullamcorper dignissim. Mauris
                  ultrices eros in cursus turpis massa tincidunt dui.
                </v-expansion-panel-content> </v-expansion-panel
              ><v-expansion-panel class="PainelTotal">
                <v-expansion-panel-header
                  :class="{ ManterCor: manter5 }"
                  @click="
                    ;(manter5 = !manter5),
                      (manter2 = false),
                      (manter3 = false),
                      (manter4 = false),
                      (manter1 = false),
                      (manter6 = false)
                  "
                  class="PainelTitulos"
                  >Tempus quam pellentesque nec nam aliquam sem et tortor
                  consequat?</v-expansion-panel-header
                >
                <v-expansion-panel-content class="PainelDescricao">
                  Molestie a iaculis at erat pellentesque adipiscing commodo.
                  Dignissim suspendisse in est ante in. Nunc vel risus commodo
                  viverra maecenas accumsan. Sit amet nisl suscipit adipiscing
                  bibendum est. Purus gravida quis blandit turpis cursus in
                </v-expansion-panel-content>
              </v-expansion-panel>
              <v-expansion-panel class="PainelTotal">
                <v-expansion-panel-header
                  :class="{ ManterCor: manter6 }"
                  @click="
                    ;(manter6 = !manter6),
                      (manter2 = false),
                      (manter3 = false),
                      (manter4 = false),
                      (manter5 = false),
                      (manter1 = false)
                  "
                  class="PainelTitulos"
                  >Tortor vitae purus faucibus ornare. Varius vel pharetra vel
                  turpis nunc eget lorem dolor?</v-expansion-panel-header
                >
                <v-expansion-panel-content class="PainelDescricao">
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris
                  vitae ultricies leo integer malesuada nunc vel. Tincidunt eget
                  nullam non nisi est sit amet. Turpis nunc eget lorem dolor
                  sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                  Pellentesque diam volutpat commodo sed egestas egestas
                  fringilla phasellus faucibus. Nibh tellus molestie nunc non
                  blandit massa enim nec.
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>
          </div>
        </v-col>
      </v-row>
    </div>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      manter1: false,
      manter2: false,
      manter3: false,
      manter4: false,
      manter5: false,
      manter6: false
    }
  }
}
</script>
<style scoped>
#FAQTotal {
  background-color: #f2f9f8;
}
#FAQ {
  margin: 0%;
  padding: 0%;
  display: flex;
  max-height: 550px;
}
#FAQTitle {
  font-size: 32px;
  font-weight: 300;
  margin-bottom: 20px;
  padding-bottom: 0;
  color: #555;
  font-family: 'Lato', sans-serif;
}
#ajustes {
  margin: 0%;
  padding: 0%;
  height: 500px;
  /* padding-top: 25px;
  padding-bottom: 25px; */
}
#ExpansionPanelsTotal {
  background-color: #f2f9f8;
}
.PainelTotal {
  background-color: #f2f9f8;
}
.PainelTitulos {
  background-color: #f2f9f8;
  font-size: 18px;
  font-weight: 500;
  font-family: 'Open Sans', sans-serif;
  color: #555;
}
.PainelTitulos:hover {
  color: #00d3b8;
}
.PainelDescricao {
  background-color: #f2f9f8;
  margin: 0%;
  padding: 0%;
  /* padding-bottom: 20px; */
  font-size: 15px;
  font-family: 'Open Sans', sans-serif;
  color: #777 !important;
}
.ManterCor {
  color: #00d3b8;
}

.v-expansion-panel::before {
  box-shadow: none !important;
}

@media screen and (max-width: 1180px) {
  #ajustes {
    height: 550px;
  }
}

@media screen and (max-width: 600px) {
  .PainelTitulos {
    font-size: 16px;
  }
  .PainelDescricao {
    font-size: 13px;
  }
  #FAQTitle {
    font-size: 28px;
  }
}
</style>
