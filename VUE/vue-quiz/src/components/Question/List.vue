<template>
    <v-data-table
        :headers="headers"
        :items="questions"
        :search="search"
        sort-by="content"
        class="elevation-1"
    >
        <template v-slot:top>
        <v-toolbar
            flat
        >
            <v-toolbar-title>List Question</v-toolbar-title>

            <v-spacer></v-spacer>
            
            <!-- Search -->
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            <!-- End Search -->

            <v-spacer></v-spacer>

            <v-dialog
                v-model="dialog"
                max-width="500px"
            >
            
                <!-- New Button -->
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                        color="primary"
                        class="mb-2"
                        v-bind="attrs"
                        v-on="on"
                        >
                        Create New Question
                        </v-btn>
                    </template>
                <!-- End New Button -->

                <!-- Modal Edit -->
                    <v-card>
                        <v-card-title>
                        <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col
                                    cols="12"
                                >
                                    <v-text-field
                                    v-model="editedItem.name"
                                    label="Question name"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                        </v-card-text>

                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="close"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="save"
                        >
                            Save
                        </v-btn>
                        </v-card-actions>
                    </v-card>
                <!-- End Modal Edit -->
            </v-dialog>

            <v-dialog v-model="dialogDelete" max-width="500px">
                <!-- Modal Delete -->
                    <v-card>
                        <v-card-title class="text-h5">Do you want to delete this exam?</v-card-title>
                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                        <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                        <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                <!-- End Delete Modal -->
            </v-dialog>
        </v-toolbar>
        </template>


        <!-- Action -->
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                    color="#daa520"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                    color="#8b008b"
                >
                    mdi-delete
                </v-icon>
                </template>
                <template v-slot:no-data>
                <v-btn
                    color="primary"
                    @click="initialize"
                >
                    Reset
                </v-btn>
            </template>
        <!-- End Action -->
    </v-data-table>
</template>

<script>
export default {
    name: 'QuestionList',
    props:{},
    data:() => ({
        dialog: false,
        dialogDelete: false,
        search: '',
        headers: [
            {
            text: 'ID',
            align: 'center',
            filterable: false,
            value: 'id',
            },
            { text: 'Content', value: 'content' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        questions: [],
        editedIndex: -1,
        editedItem: {
            name: ''
        },
        defaultItem: {
            name: ''
        },

    }),
    computed: {
        formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
    },

    watch: {
        dialog (val) {
        val || this.close()
        },
        dialogDelete (val) {
        val || this.closeDelete()
        },
    },

    created () {
        this.initialize()
    },

    methods: {
        initialize () {
            this.questions = [
                {
                    "id": 51,
                    "content": "Error excepturi voluptatem et dolorum. Non sunt voluptatum quo veritatis. Perspiciatis odio aliquid in commodi. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 201,
                            "question_id": 51,
                            "content": "Iure voluptas vel quia possimus ex.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 202,
                            "question_id": 51,
                            "content": "Omnis deleniti officiis et doloribus.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 203,
                            "question_id": 51,
                            "content": "Repellendus unde voluptas sed officiis.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 204,
                            "question_id": 51,
                            "content": "Nam tempore impedit cumque maiores.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 52,
                    "content": "Ad laboriosam modi architecto amet repudiandae. Repellendus consequatur ut qui est reiciendis fuga. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 205,
                            "question_id": 52,
                            "content": "Qui amet occaecati corporis reprehenderit.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 206,
                            "question_id": 52,
                            "content": "Perspiciatis tenetur dolores dolorem est cumque.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 207,
                            "question_id": 52,
                            "content": "Ullam tempore iusto occaecati.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 208,
                            "question_id": 52,
                            "content": "Delectus nobis placeat alias velit ducimus.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 53,
                    "content": "Facilis quasi eum quia ab. Odio dignissimos dignissimos id tenetur. Sint voluptas natus rerum esse esse neque et. Aspernatur et labore et veritatis. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 209,
                            "question_id": 53,
                            "content": "Sed facere dolorem ut et.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 210,
                            "question_id": 53,
                            "content": "Sapiente dolorum sunt provident.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 211,
                            "question_id": 53,
                            "content": "Minus tempore ipsa ad nihil eligendi omnis.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 212,
                            "question_id": 53,
                            "content": "Iste repellendus omnis omnis molestias.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 54,
                    "content": "Sunt ut voluptates maxime est rerum aut. Libero sed et saepe corrupti at nisi. Veniam nulla voluptas eveniet vero. Harum recusandae non qui. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 213,
                            "question_id": 54,
                            "content": "Quia laborum voluptas sint nihil aut qui.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 214,
                            "question_id": 54,
                            "content": "Aut quaerat enim eum rerum atque ut.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 215,
                            "question_id": 54,
                            "content": "Veritatis ut ad est qui ut eum ullam.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 216,
                            "question_id": 54,
                            "content": "Quos sunt numquam est labore ullam.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 55,
                    "content": "Odit et est enim blanditiis ullam vitae. Vel ipsa aut nostrum nobis. Eveniet repudiandae voluptatem consequatur aut libero molestiae dolores. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 217,
                            "question_id": 55,
                            "content": "Veritatis sint et qui ut molestias.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 218,
                            "question_id": 55,
                            "content": "Doloremque corrupti qui error non.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 219,
                            "question_id": 55,
                            "content": "In natus ut repellat tenetur.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 220,
                            "question_id": 55,
                            "content": "Consequatur et sit sit atque voluptate.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 56,
                    "content": "Ut cum voluptatem necessitatibus nemo sit culpa. Et quod numquam ab. Tempora sit voluptatibus sint cum eos. Voluptatem id tenetur et est. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 221,
                            "question_id": 56,
                            "content": "Ipsum et non odit officia.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 222,
                            "question_id": 56,
                            "content": "Deleniti odit dolorem cumque sit a.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 223,
                            "question_id": 56,
                            "content": "Voluptates et veritatis nam sequi et nemo eum.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 224,
                            "question_id": 56,
                            "content": "Repellendus ut nam eum aut sed quae.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 57,
                    "content": "Similique libero ex non totam delectus. Voluptate et cumque consequatur reiciendis iusto omnis. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 225,
                            "question_id": 57,
                            "content": "Ut rerum recusandae et autem itaque unde non.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 226,
                            "question_id": 57,
                            "content": "Ut qui facere quasi mollitia.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 227,
                            "question_id": 57,
                            "content": "Earum dolore quisquam enim enim doloremque.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 228,
                            "question_id": 57,
                            "content": "Qui nemo distinctio asperiores nam voluptas.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 58,
                    "content": "Ipsum sit hic adipisci aliquid. Pariatur corrupti qui velit molestias est. Inventore illo sint et. Culpa eos provident cumque optio aut sapiente nam. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 229,
                            "question_id": 58,
                            "content": "Voluptatem occaecati qui iste tenetur.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 230,
                            "question_id": 58,
                            "content": "Corporis sit cupiditate quas.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 231,
                            "question_id": 58,
                            "content": "Atque facere ipsa est.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 232,
                            "question_id": 58,
                            "content": "Et pariatur necessitatibus iste voluptatem.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 59,
                    "content": "Omnis quam aliquid dolore. Tempora molestiae molestias et et dicta repellendus sed. Architecto pariatur nisi aperiam dolores. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 233,
                            "question_id": 59,
                            "content": "Ipsa quas sint voluptatem et aliquam dicta.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 234,
                            "question_id": 59,
                            "content": "Repellendus est aut aliquam est.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 235,
                            "question_id": 59,
                            "content": "Quod iure dolores aut totam suscipit nulla.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 236,
                            "question_id": 59,
                            "content": "Laboriosam natus modi sed.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 60,
                    "content": "Voluptatem officiis ab explicabo aut. Molestiae laudantium accusamus sapiente hic necessitatibus eum. Atque nam dolorum eum soluta iure. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 237,
                            "question_id": 60,
                            "content": "Laudantium corporis vero iste inventore.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 238,
                            "question_id": 60,
                            "content": "Facilis illum omnis voluptatum dolor similique.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 239,
                            "question_id": 60,
                            "content": "Qui et similique animi ut et natus voluptatem.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 240,
                            "question_id": 60,
                            "content": "Sapiente voluptas similique in rem.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 61,
                    "content": "Nisi consequuntur magni architecto tenetur et. Eius ut nobis et omnis. Est facilis magni nemo et. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 241,
                            "question_id": 61,
                            "content": "Soluta voluptate voluptatem a ut unde quo.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 242,
                            "question_id": 61,
                            "content": "Et vero minima ex sunt.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 243,
                            "question_id": 61,
                            "content": "Eveniet in voluptas odit et in mollitia ut.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 244,
                            "question_id": 61,
                            "content": "Est natus iste quibusdam veniam nostrum vel.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 62,
                    "content": "Quos ea quae nulla aut incidunt. Recusandae est veniam laboriosam. Sit soluta maxime consequatur debitis incidunt est aperiam. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 245,
                            "question_id": 62,
                            "content": "Dolorem similique aspernatur odio natus sit.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 246,
                            "question_id": 62,
                            "content": "Sit aut velit porro et.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 247,
                            "question_id": 62,
                            "content": "Quisquam eveniet aut autem rem consequatur.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 248,
                            "question_id": 62,
                            "content": "Corporis eius porro numquam ea provident et aut.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 63,
                    "content": "Distinctio facere temporibus reprehenderit explicabo. Quia labore est aut sapiente qui reprehenderit et. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 249,
                            "question_id": 63,
                            "content": "Qui debitis ut recusandae.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 250,
                            "question_id": 63,
                            "content": "Odit reiciendis a sit exercitationem.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 251,
                            "question_id": 63,
                            "content": "At in quisquam ea voluptates id esse.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 252,
                            "question_id": 63,
                            "content": "Et atque qui enim voluptate occaecati.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 64,
                    "content": "Ut ut optio et. Optio cum quos est a. Qui aut autem exercitationem ut molestias ratione qui. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 253,
                            "question_id": 64,
                            "content": "Sapiente beatae quo architecto.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 254,
                            "question_id": 64,
                            "content": "Aut fuga et vel. Quis quia aperiam enim sunt.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 255,
                            "question_id": 64,
                            "content": "Non ut aut earum molestias dolores modi rerum.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 256,
                            "question_id": 64,
                            "content": "Est aut perferendis aut minima eius.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 65,
                    "content": "In aut quia consequatur est. Velit cupiditate magnam ipsa debitis voluptatum adipisci in. Natus aut vitae quia totam sed. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 257,
                            "question_id": 65,
                            "content": "Sit molestias qui excepturi hic quibusdam ad in.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 258,
                            "question_id": 65,
                            "content": "Nostrum necessitatibus veniam et sed sed quidem.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 259,
                            "question_id": 65,
                            "content": "At sit nisi rerum voluptas.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 260,
                            "question_id": 65,
                            "content": "Sequi voluptate ipsam est.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 66,
                    "content": "Accusamus deleniti aut et eos ipsum rerum. Iusto libero sunt dolores voluptatem explicabo. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 261,
                            "question_id": 66,
                            "content": "Ut magni magnam accusantium fugit tenetur.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 262,
                            "question_id": 66,
                            "content": "Rerum eum aut quod dolor nostrum sequi et.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 263,
                            "question_id": 66,
                            "content": "Ullam ut eum quisquam.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 264,
                            "question_id": 66,
                            "content": "Qui quas dicta reiciendis placeat tempore veniam.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 67,
                    "content": "Ab suscipit ut debitis exercitationem. Voluptatem id sequi ea quae quia facere atque. Porro adipisci possimus quo minus odit. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 265,
                            "question_id": 67,
                            "content": "Quod rerum nihil commodi est placeat.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 266,
                            "question_id": 67,
                            "content": "Quidem qui non sunt ex.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 267,
                            "question_id": 67,
                            "content": "Officia dolorem autem nulla ut.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 268,
                            "question_id": 67,
                            "content": "Sint et quia est possimus iusto eius non saepe.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 68,
                    "content": "Eius quam tenetur nihil suscipit libero. Consequatur non quis aut illo ab. Sit nostrum nihil provident in. Aut odit qui consequuntur ex. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 269,
                            "question_id": 68,
                            "content": "Voluptatem numquam aut consequuntur magnam.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 270,
                            "question_id": 68,
                            "content": "At in facere illo minus ducimus.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 271,
                            "question_id": 68,
                            "content": "Vel illo inventore autem autem aut quasi.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 272,
                            "question_id": 68,
                            "content": "Voluptatum velit quia ut.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 69,
                    "content": "Quia omnis officia omnis labore unde omnis enim. Optio enim quisquam dignissimos omnis et non. Asperiores qui et ipsum voluptates et. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 273,
                            "question_id": 69,
                            "content": "Suscipit autem harum et commodi.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 274,
                            "question_id": 69,
                            "content": "Cupiditate sit enim distinctio.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 275,
                            "question_id": 69,
                            "content": "Qui ipsum ipsum deleniti omnis est ea at.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 276,
                            "question_id": 69,
                            "content": "Sed sit molestiae ut blanditiis nam et ipsa.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 70,
                    "content": "Omnis similique voluptas qui rerum ea iste ea facere. Dolor ut rerum iusto ex. Nesciunt id enim ducimus. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 277,
                            "question_id": 70,
                            "content": "Ut officia dolore soluta sint.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 278,
                            "question_id": 70,
                            "content": "Sed culpa aut dolor qui.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 279,
                            "question_id": 70,
                            "content": "Aut doloribus quia ut perferendis.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 280,
                            "question_id": 70,
                            "content": "Ea amet autem nostrum sit quia.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 71,
                    "content": "Quo quidem voluptatem magni tempora dolor deleniti. Voluptates incidunt aliquam ut dolores temporibus. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 281,
                            "question_id": 71,
                            "content": "Occaecati nihil molestias voluptatem sint fuga.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 282,
                            "question_id": 71,
                            "content": "Nemo ad sed cum eveniet.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 283,
                            "question_id": 71,
                            "content": "Qui incidunt voluptatem ratione totam aut.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 284,
                            "question_id": 71,
                            "content": "Impedit labore et numquam consectetur.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 72,
                    "content": "Eos dolores pariatur assumenda non. Optio possimus aperiam aut vel et. Aut rerum quam quidem quas. Id voluptate modi omnis in similique et et. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 285,
                            "question_id": 72,
                            "content": "Ducimus et rerum vitae.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 286,
                            "question_id": 72,
                            "content": "Ut voluptates accusamus pariatur ut.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 287,
                            "question_id": 72,
                            "content": "Quo magni maiores qui adipisci sed amet dolores.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 288,
                            "question_id": 72,
                            "content": "Possimus qui perferendis qui minima.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 73,
                    "content": "Repudiandae est fugit est. Reprehenderit quo est autem saepe neque esse. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 289,
                            "question_id": 73,
                            "content": "Culpa incidunt iste ut est.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 290,
                            "question_id": 73,
                            "content": "Enim quos ut aut.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 291,
                            "question_id": 73,
                            "content": "Ipsa harum est maiores quibusdam et repellat ea.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 292,
                            "question_id": 73,
                            "content": "Est reiciendis doloremque ex.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 74,
                    "content": "Fugit quasi vitae voluptas illum et ea aut. Molestiae reprehenderit est quo blanditiis. Quia et labore aut quod soluta maxime corrupti nostrum. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 293,
                            "question_id": 74,
                            "content": "Omnis excepturi et officia qui ea magni labore.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 294,
                            "question_id": 74,
                            "content": "Nulla itaque ab illum quidem.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 295,
                            "question_id": 74,
                            "content": "Enim ut itaque ea consequatur.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 296,
                            "question_id": 74,
                            "content": "Eius consequatur vel quia et. Fuga ea minima sit.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                },
                {
                    "id": 75,
                    "content": "Deleniti aut tempore sit. Qui dolor culpa asperiores fugiat aut. Nostrum assumenda ipsum facere qui maxime. ?",
                    "created_at": "2021-08-27T21:15:28.000000Z",
                    "updated_at": "2021-08-27T21:15:28.000000Z",
                    "answers": [
                        {
                            "id": 297,
                            "question_id": 75,
                            "content": "Aliquid ut corporis at illo.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 298,
                            "question_id": 75,
                            "content": "Aut omnis beatae accusantium ut cupiditate eius.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 299,
                            "question_id": 75,
                            "content": "In qui quasi mollitia quia vel et.",
                            "correct": 0,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        },
                        {
                            "id": 300,
                            "question_id": 75,
                            "content": "Quia impedit ea rem consequuntur totam porro.",
                            "correct": 1,
                            "created_at": "2021-08-27T21:15:29.000000Z",
                            "updated_at": "2021-08-27T21:15:29.000000Z"
                        }
                    ]
                }
            ];
        },

        editItem (item) {
        this.editedIndex = this.questions.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
        },

        deleteItem (item) {
        this.editedIndex = this.questions.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
        },

        deleteItemConfirm () {
        this.questions.splice(this.editedIndex, 1)
        this.closeDelete()
        },

        close () {
        this.dialog = false
        this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
        })
        },

        closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
        })
        },

        save () {
        if (this.editedIndex > -1) {
            Object.assign(this.questions[this.editedIndex], this.editedItem)
        } else {
            this.questions.push(this.editedItem)
        }
        this.close()
        },
    }
}
</script>

<style>
    .theme--light.v-data-table > .v-data-table__wrapper > table > thead > tr:last-child > th {
        white-space: nowrap;
    }

    .theme--light.v-data-table > .v-data-table__wrapper > table > thead > tr:last-child > th span{
        margin-right: 3px;
    }

    .v-application div.elevation-1{
        box-shadow: none !important;
    }
</style>