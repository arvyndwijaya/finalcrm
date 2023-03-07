<template>
    <v-row>
        <v-col cols="6">
            <v-text-field
                label="Invoice"
                v-model="salesOrder.soInvoice"
                readonly
            />
        </v-col>
        <v-col cols="6">
            <v-text-field
                label="Date"
                v-model="salesOrder.soDate"
                readonly
            />
        </v-col>
        <v-col cols="6">
            <v-text-field
                label="Customer Code"
                v-model="customer.customerCode"
                readonly
            />
        </v-col>
        <v-col cols="6">
            <v-text-field
                label="Customer Name"
                v-model="customer.customerName"
                readonly
            />
        </v-col>
        <v-col cols="6">
            <v-text-field
                label="Customer Mobile Phone"
                v-model="customer.customerNoHandphone"
                readonly
            />
        </v-col>
        <v-col cols="6">
            <v-text-field
                label="Customer Email"
                v-model="customer.customerEmail"
                readonly
            />
        </v-col>
    </v-row>
    <v-table>
        <thead>
            <tr>
                <th class="text-left">Material Code</th>
                <th class="text-left">Material Name</th>
                <th class="text-left">Qty</th>
                <th class="text-left">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr
                v-for="material in salesOrder.soMaterials"
                :key="material.materialId"
            >
                <td>{{ material.materialCode }}</td>
                <td>{{ material.materialName }}</td>
                <td>{{ material.qty }}</td>
                <td>{{ this.handleFormatCurrency(material.materialPrice) }}</td>
            </tr>
            <tr v-if="salesOrder.soMaterials !== undefined">
                <td>Total</td>
                <td></td>
                <td>{{ salesOrder.soTotalQty }}</td>
                <td>{{ this.handleFormatCurrency(salesOrder.soTotalPrice) }}</td>
            </tr>
        </tbody>
    </v-table>
</template>

<script>
    import { sendRequest } from '../../utils/request'

    export default {
        data: () => ({
            customer: {},
            salesOrder: {}
        }),
        mounted() {
            this.fetchSalesOrder(this.$route.params.id)
        },
        methods: {
            async fetchSalesOrder(id) {
                sendRequest('GET', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/sales-order/${id}`)
                .then(res => {
                    if (!res.status) throw new Error(res.message)
                    this.customer   = res.data.customer
                    this.salesOrder = res.data
                })
                .catch(err => {
                    alert(err)
                    // window.location.href = '/sales-order'
                })
            },
            handleFormatCurrency(currency) {
                return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'IDR' }).format(currency)
            }
        }
    }
</script>