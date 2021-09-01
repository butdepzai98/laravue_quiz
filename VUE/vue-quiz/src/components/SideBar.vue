<template>
    <v-col cols="2">
        <v-sheet rounded="lg">
            <v-list color="transparent">
            <v-list-item
                v-for="sbitem in sidebarItems"
                :key="sbitem"
                link
            >
                <v-list-item-content>
                <v-list-item-title>
                    {{ sbitem.text }}
                </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            </v-list>
        </v-sheet>
    </v-col>
</template>

<script>
export default {
    name: 'SideBar',
    props:{},
    data:() =>({
        sidebarItems:[
            {
                text: 'Sidebar',
                href: 'breadcrumbs_dashboard',
            },
            {
                text: 'Sidebar 1',
                href: 'breadcrumbs_link_1',
            },
            {
                text: 'Sidebar 2',
                href: 'breadcrumbs_link_2',
            }
        ]
    }),
    methods:{
        
    }
}
</script>

<style>

</style>