<template>
  <div>
      <v-btn
        v-model="selectedItem"
        v-for="link in links"
        :key="link"
        text
        :to="link.route"
        >
            {{ link.text }}
        </v-btn>
  </div>
</template>

<script>
export default {
    name: 'NavBar',
    data:() => ({
        selectedItem: 0,
        links: [
            {text: 'Exams', route: '/exam'},
            {text: 'Questions', route: '/question'},
            {text: 'Results', route: '/result'},
            {text: 'Users', route: '/user'}
        ]
    })
}
</script>

<style scope>
    a.theme--light.v-btn--active:hover::before, a.theme--light.v-btn--active::before {
        opacity: 0;
    }

    a.v-btn--active:after {
        position: absolute;
        content: "";
        width: 60%;
        bottom: 0;
        border-bottom: 2px solid #35495e;
    }
</style>