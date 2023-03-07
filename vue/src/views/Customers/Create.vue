<template>
    <form @submit.prevent="submit">
        <v-text-field
            v-model="customerName.value.value"
            :error-messages="customerName.errorMessage.value"
            label="Name"
        />
        <v-text-field
            v-model="customerBirthDate.value.value"
            :error-messages="customerBirthDate.errorMessage.value"
            label="Birth Date"
            type="date"
        />
        <v-textarea
            label="Address"
            v-model="customerAddress.value.value"
            :error-messages="customerAddress.errorMessage.value"
        />
        <v-text-field
            v-model="customerCity.value.value"
            :error-messages="customerCity.errorMessage.value"
            label="City"
        />
        <v-text-field
            v-model="customerNoHandphone.value.value"
            :error-messages="customerNoHandphone.errorMessage.value"
            label="Phone Number"
        />
        <v-text-field
            v-model="customerEmail.value.value"
            :error-messages="customerEmail.errorMessage.value"
            label="E-mail"
        />
        <v-btn
            class="me-4"
            type="submit"
        >
            Submit
        </v-btn>
        <v-btn @click="handleReset">
            Clear
        </v-btn>
    </form>
</template>

<script>
    import { ref } from 'vue'
    import { useField, useForm } from 'vee-validate'
    import { sendRequest } from '../../utils/request'
    
    export default {
        mounted() {
        },
        setup () {
            const { handleSubmit, handleReset } = useForm({
                validationSchema: {
                    customerName (value) {
                        if (value?.length >= 3) return true
                        return 'Name needs to be at least 3 characters.'
                    },
                    customerBirthDate (value) {
                        if (value?.length === 10) return true
                        return 'Birth date cannot be null.'
                    },
                    customerAddress (value) {
                        if (value?.length >= 10) return true
                        return 'Address needs to be at least 10 characters.'
                    },
                    customerCity (value) {
                        if (value?.length >= 3) return true
                        return 'City needs to be at least 3 characters.'
                    },
                    customerNoHandphone (value) {
                        if (value?.length > 9 && /[0-9-]+/.test(value)) return true

                        return 'Phone number needs to be at least 9 digits.'
                    },
                    customerEmail (value) {
                        if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value)) return true

                        return 'Must be a valid e-mail.'
                    },
                },
            })

            const customerName        = useField('customerName')
            const customerBirthDate   = useField('customerBirthDate')
            const customerAddress     = useField('customerAddress')
            const customerCity        = useField('customerCity')
            const customerNoHandphone = useField('customerNoHandphone')
            const customerEmail       = useField('customerEmail')

            const items = ref([
                'Item 1',
                'Item 2',
                'Item 3',
                'Item 4',
                'Item 5',
                'Item 6',
            ])

            const submit = handleSubmit(values => {
                sendRequest('POST', `${import.meta.env.VITE_APP_BACKEND_HOST}/api/v1/customers`, values)
                .then(res => {
                    if (res.status) {
                        window.location.href = "/customers"
                    }
                })
                .catch(err => {
                    console.log(err)
                })
            })

            return { customerName, customerBirthDate, customerAddress, customerCity, customerNoHandphone, customerEmail, items, submit, handleReset }
        },
    }
</script>