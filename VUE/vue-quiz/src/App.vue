<template>
  <v-app id="inspire">
    <v-app-bar
      app
      color="white"
      flat
    >
      <v-container class="py-0 fill-height">
        <v-btn to="/"
          v-on="on"
          min-width=32
          width=32
          depressed=false
          text=false
          class="ml-10"
          >
            <v-avatar
              size="32"
              style="border-radius: 0"
            >
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="36px" width="36px" role="img" aria-hidden="true" class="v-icon__svg"><path d="M12,11.64L7.92,2H16.08L12,11.64M12,21.95L3.27,4.91H7.84L12,14.47L16.16,4.91H20.73L12,21.95Z"></path>
              </svg>
            </v-avatar>
        </v-btn>
        
        <!-- NavBar Button -->
        <NavBar v-if="logged"/>
        <!-- NavBar Button -->

        <v-spacer></v-spacer>

        <v-responsive max-width="260"  v-if="logged">
          <v-text-field
            dense
            flat
            hide-details
            rounded
            solo-inverted
          ></v-text-field>
        </v-responsive>
        <v-menu 
          v-if="logged"
          offset-overflow
          offset-y
        >
          <template v-slot:activator="{on}">
            <v-btn
              v-on="on"
              min-width=32
              width=32
              depressed=false
              text=false
              class="ml-10"
            >
              <v-avatar
                size="32"
                style="border-radius: 0"
              >
                <v-img src="../src/assets/logo.png"/>
              </v-avatar>
            </v-btn>
          </template>
          <v-list>
            <v-list-item 
              @click="onClick"
              v-for="(item, index) in profileItems"
              :key="index"
            >
              <v-list-item-title>{{ item.text }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-container>
    </v-app-bar>

    <v-main class="grey lighten-3">
      <v-container>
        <v-row>
          <!-- Side bar -->
          <SideBar v-if="logged"/>
          <!-- End Side bar -->

          <!-- Col Main -->
          <v-col>
            <v-sheet
              min-height="70vh"
              rounded="lg"
            >
              <v-breadcrumbs :items="breadcrumbItems" v-if="logged">
                <template v-slot:divider>
                  <v-icon>mdi-chevron-right</v-icon>
                </template>
              </v-breadcrumbs>
              <!-- Main -->
              <v-main style="padding: 0px 24px">
                <router-view></router-view>
              </v-main>
              <!-- End Main -->
            </v-sheet>
          </v-col>
          <!-- End Col Main -->
        </v-row>
      </v-container>

      <!-- Footer -->
        <v-footer class="text-center">
          <p class="text-center mb-0">
            @Design by XuanVinh 2021
          </p>
        </v-footer>
        <!-- End Footer -->
    </v-main>
  </v-app>
</template>

<script>
import NavBar from './components/NavBar';
import SideBar from './components/SideBar';

export default {
  name: 'App',

  components: {
    NavBar,
    SideBar
  },

  data: () => ({
    logged: false,

    breadcrumbItems: [
      {
        text: 'Home',
        disabled: false,
        href: 'breadcrumbs_dashboard',
      },
      {
        text: 'Link 1',
        disabled: false,
        href: 'breadcrumbs_link_1',
      },
      {
        text: 'Link 2',
        disabled: true,
        href: 'breadcrumbs_link_2',
      },
    ],
    profileItems:[
      {
        text: 'Profile',
        href: 'breadcrumbs_dashboard',
      },
      {
        text: 'Logout',
        href: 'breadcrumbs_link_1',
      }
    ],
  }),
  methods: {
    onClick () {
      // Perform an action
    },
  },
};
</script>


<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}

footer p{
  font-size: 12px;
}
</style>
