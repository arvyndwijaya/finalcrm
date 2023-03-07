<template>
    <v-form ref="form">
        <v-text-field
            label="Name"
            v-model="customer.customerName"
            :rules="customer.customerNameRule"
            required
        />
        <v-text-field
            type="date"
            label="Birth Date"
            v-model="customer.customerBirthDate"
            :rules="customer.customerBirthDateRule"
            required
        />
        <v-textarea
            label="Address"
            v-model="customer.customerAddress"
            :rules="customer.customerAddressRule"
            required
        />
        <v-text-field
            label="City"
            v-model="customer.customerCity"
            :rules="customer.customerCityRule"
            required
        />
        <v-text-field
            label="Phone Number"
            v-model="customer.customerNoHandphone"
            :rules="customer.customerNoHandphoneRule"
            required
        />
        <v-text-field
            label="E-mail"
            v-model="customer.customerEmail"
            :rules="customer.customerEmailRule"
            required
        />
        <v-btn
            class="me-4"
            @click="validate"
        >
            Submit
        </v-btn>
        <v-btn @click="handleReset">
            Clear
        </v-btn>
    </v-form>
</template>

<script>
    import { sendRequest } from '../../utils/request'
    
    export default {
        data: () => ({
            valid: true,
            customer: {
                customerName: "",
                customerNameRule: [
                    v => !!v || 'Name is required',
                    v => (v && v.length >= 3) || 'Name needs to be at least 3 characters.',
                ],
                customerBirthDate: "",
                customerBirthDateRule: [
                    v => !!v || 'Birth date is required',
                    v => (v && v.length !== 10) || 'Birth date cannot be null.',
                ],
                customerAddress: "",
                customerAddressRule: [
                    v => !!v || 'Address is required',
                    v => (v && v.length >= 10) || 'Address needs to be at least 10 characters.',
                ],
                customerCity: "",
                customerCityRule: [
                    v => !!v || 'City is required',
                    v => (v && v.length >= 3) || 'City needs to be at least 3 characters.',
                ],
                customerNoHandphone: "",
                customerNoHandphoneRule: [
                    v => !!v || 'Phone Number is required',            
                    v => (v && v.length >= 9) || 'Phone number needs to be at least 9 digits.',
                ],
                customerEmail: "",
                customerEmailRule: [
                    v => !!v || 'Email is required',
                    v => /^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(v) || 'Must be a valid e-mail.' 
                ]
            }
        }),
        mounted() {
            this.fetchCustomer(this.$route.params.id)
        },
        methods: {
            async fetchCustomer(id) {
                sendRequest('GET', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customers/${id}`)
                .then(res => {
                    if (!res.status) throw new Error(res.message)
                    this.customer = res.data
                })
                .catch(err => {
                    alert(err)
                    window.location.href = '/customers'
                })
            },
            async validate () {
                const { valid } = await this.$refs.form.validate()
                if (valid) {
                    sendRequest('PUT', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customers/${this.$route.params.id}`, {
                        customerName: this.customer.customerName,
                        customerBirthDate: this.customer.customerBirthDate,
                        customerAddress: this.customer.customerAddress,
                        customerCity: this.customer.customerCity,
                        customerNoHandphone: this.customer.customerNoHandphone,
                        customerEmail: this.customer.customerEmail
                    })
                    .then(res => {
                        if (!res.status) throw new Error(res.message)
                        window.location.href = "/customers"
                    })
                    .catch(err => {
                        alert(err)
                    })
                }
            },
            reset () {
                this.$refs.form.reset()
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            },
        }
    }
</script>