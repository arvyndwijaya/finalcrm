<template>
    <div class="d-flex justify-end flex-wrap">
        <v-card
            color="grey-lighten-3"
        >
            <v-card-text style="width: 400px;">
                <v-text-field
                    density="compact"
                    variant="solo"
                    label="Search sales order"
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
                <th class="text-left">Invoice</th>
                <th class="text-left">Customer</th>
                <th class="text-left">Tanggal</th>
                <th class="text-left">Total Qty</th>
                <th class="text-left">Total Price</th>
                <th class="text-left">#</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="salesOrder in salesOrders"
                :key="salesOrder.soInvoice"
            >
                <td>{{ salesOrder.soInvoice }}</td>
                <td>{{ salesOrder.customer.customerCode }} - {{ salesOrder.customer.customerName }}</td>
                <td>{{ salesOrder.soDate }}</td>
                <td>{{ salesOrder.soTotalQty }}</td>
                <td>{{ this.handleFormatCurrency(salesOrder.soTotalPrice) }}</td>
                <td>
                    <v-btn
                        color="info"
                        icon="mdi-eye"
                        size="small"
                        @click="$router.push(`/sales-order/${salesOrder.soId}`)"
                    />
                </td>
            </tr>
        </tbody>
    </v-table>
</template>

<script lang="js">
    import { sendRequest } from '../../utils/request'

    export default {
        mounted() {
            this.handleSalesOrder(`${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/sales-order`)
        },
        data () {
            return {
                salesOrders: []
            }
        },
        methods: {
            handleSalesOrder(url) {
                sendRequest('GET', url)
                .then(res => {
                    this.salesOrders = res.data
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
                    this.handleSalesOrder(`${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/sales-order?search=${e.target.value}`)
                }
            }
        }
    }
</script>