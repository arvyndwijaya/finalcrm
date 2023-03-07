<template>
    <div class="d-flex justify-end flex-wrap">
        <v-card
            color="grey-lighten-3"
        >
            <v-card-text style="width: 400px;">
                <v-text-field
                    density="compact"
                    variant="solo"
                    label="Search materials"
                    append-inner-icon="mdi-magnify"
                    single-line
                    hide-details
                    v-on:keyup="handleSearch"
                ></v-text-field>
            </v-card-text>
        </v-card>
    </div>
    <v-table>
        <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Code</th>
                <th class="text-left">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="(material, index) in materials"
                :key="index"
            >
                <td>{{ material.materialName }}</td>
                <td>{{ material.materialCode }}</td>
                <td>{{ this.handleFormatCurrency(material.materialPrice) }}</td>
            </tr>
        </tbody>
    </v-table>
</template>

<script lang="js">
    import { sendRequest } from '../../utils/request'

    export default {
        mounted() {
            this.handleMaterials(`${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/materials`)
        },
        data () {
            return {
                materials: []
            }
        },
        methods: {
            handleMaterials(url) {
                sendRequest('GET', url)
                .then(res => {
                    this.materials = res.data
                })
                .catch(err => {
                    console.log(err)
                })
            },
            handleFormatCurrency(currency) {
                return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(currency)
            },
            handleSearch(e) {
                if (e.keyCode === 13) {
                    this.handleMaterials(`${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/materials?search=${e.target.value}`)
                }
            }
        }
    }
</script>