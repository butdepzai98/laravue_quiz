<template>
  <v-container class="register-page">
    <v-row class="text-center">
      <v-col cols="12">
        <v-img
          :src="require('../assets/logo.png')"
          class="logo-home"
          contain
          max-height="50"
          max-width="50"
        />
      </v-col>

      <v-col class="col-12">
        <h1 class="display-1 font-weight-bold">
          Register Account
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
              :rules="[v => !!v || 'You must agree to continue!']"
              label="Agree to our policy ?"
              required
            ></v-checkbox>

            <v-col cols="12">
                <v-btn
                  color="primary"
                  to="/"
                  text
                >
                  You had already account ?
                </v-btn>
            </v-col>

            <v-col cols="12" class="col-btn-form-footer">
              <v-btn
                :disabled="!valid"
                color="success"
                class="mr-4"
                @click="validate"
              >
                Register
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
  </v-container>
</template>

<script>
export default {
  name: 'Home',
  components: {
    
  },
  data: () => ({
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