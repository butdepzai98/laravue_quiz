<template>
  <v-container>
    <!-- if Logged -->
    <v-row class="text-center" v-if="!logged">
      <v-col cols="12">
        <v-img
          :src="require('../assets/logo.png')"
          class="logo-home"
          contain
          max-height="150"
          max-width="150"
        />
      </v-col>

      <v-col class="col-12">
        <h1 class="display-1 font-weight-bold">
          Welcome to Vuetify Quiz Managerment
        </h1>
      </v-col>

      <!-- Form Login -->
      <v-form 
        v-model="valid" 
        class="form-login-register"
        lazy-validation
        ref="form"
      >
        <v-container>
          <v-row>
            <v-col
              cols="12"
            >
              <v-text-field
                v-model="name"
                :rules="nameRules"
                label="User name"
                required
              ></v-text-field>
            </v-col>
    
            <v-col
              cols="12"
            >
              <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                required
              ></v-text-field>
            </v-col>

            <v-checkbox
              v-model="checkbox"
              label="Remember to login ?"
              checked
            ></v-checkbox>

            <v-col cols="12" class="col-btn-form-footer">
              <v-btn
                :disabled="!valid"
                color="primary"
                class="mr-4"
                @click="validate"
              >
                Login
              </v-btn>
          
              <v-btn
                color="light"
                class="mr-4"
                @click="reset"
              >
                Reset
              </v-btn>
            </v-col>

          </v-row>
        </v-container>
    </v-form>
      <!-- End Form Login -->
    </v-row>
    <!-- End if Logged -->

    <!-- if haven't Logged -->
    <v-row class="text-center" v-if="logged">
      <v-col cols="12">
        <v-img
          :src="require('../assets/logo.png')"
          class="my-3"
          contain
          height="200"
        />
      </v-col>

      <v-col class="mb-4">
        <h1 class="display-2 font-weight-bold mb-3">
          Welcome to Vuetify
        </h1>
      </v-col>
    </v-row>
    <!-- end if haven't Logged -->
  </v-container>
</template>

<script>
// @ is an alias to /src

export default {
  name: 'Home',
  components: {
    
  },
  data: () => ({
    logged: false,
    valid: true,
    name: '',
    nameRules: [
      v => !!v || 'Name is required',
    ],
    email: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
    ],
    checkbox: true,
  }),

  methods: {
    validate () {
      this.$refs.form.validate()
    },
    reset () {
      this.$refs.form.reset()
    },
    resetValidation () {
      this.$refs.form.resetValidation()
    },
  },
}
</script>

<style scoped>
  .form-login .row >.col-12{
    padding-bottom: 0;
  }
</style>

<style>
  .logo-home{
    margin: 0 auto;
  }
  .col-btn-form-footer{
    margin-bottom: 60px;
  }

  .form-login-register{
    margin: 0 auto;
  }
</style>