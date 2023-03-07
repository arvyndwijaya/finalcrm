<template>
    <div class="d-flex justify-end flex-wrap">
        <v-card
            color="grey-lighten-3"
        >
            <v-card-text style="width: 400px;">
                <v-text-field
                    density="compact"
                    variant="solo"
                    label="Search customer receipts"
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
            <tr style="white-space: nowrap;">
                <th class="text-left">Name</th>
                <th class="text-left">Code</th>
                <th class="text-left">Customer</th>
                <th class="text-left">Spheris</th>
                <th class="text-left">Cylinder</th>
                <th class="text-left">Addition</th>
                <th class="text-left">Axis</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="(customer, index) in customers"
                :key="index"
                style="white-space: nowrap;"
            >
                <td>{{ customer.customerReceiptName }}</td>
                <td>{{ customer.customerReceiptCode }}</td>
                <td>{{ customer.customerCode }} - {{ customer.customerName }}</td>
                <td>
                    {{ `R ${customer.customerReceiptSpherisRight}` }}
                    <br/>
                    {{ `L ${customer.customerReceiptSpherisLeft}` }}
                </td>
                <td>
                    {{ `R ${customer.customerReceiptCylinderRight}` }}
                    <br/>
                    {{ `L ${customer.customerReceiptCylinderLeft}` }}
                </td>
                <td>
                    {{ `R ${customer.customerReceiptAdditionRight}` }}
                    <br/>
                    {{ `L ${customer.customerReceiptAdditionLeft}` }}
                </td>
                <td>
                    {{ `R ${customer.customerReceiptAxisRight}` }}
                    <br/>
                    {{ `L ${customer.customerReceiptAxisLeft}` }}
                </td>
            </tr>
        </tbody>
    </v-table>
</template>

<script lang="js">
    import { sendRequest } from '../../utils/request';

    export default {
        mounted() {
            this.handleCustomerReceipts(`${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customer-receipts`)
        },
        data () {
            return {
                customers: []
            }
        },
        methods: {
            handleCustomerReceipts(url) {
                sendRequest('GET', url)
                .then(res => {
                    this.customers = res.data
                })
                .catch(err => {
                    console.log(err)
                })
            },
            handleSearch(e) {
                if (e.keyCode === 13) {
                    this.handleCustomerReceipts(`${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customer-receipts?search=${e.target.value}`)
                }
            }
        }
    }
</script>