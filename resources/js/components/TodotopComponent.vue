<template>
    <p>test</p>
    <p>{{ message2 }}</p>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },

    const: appdata = {
        data(){
            return {
                // ↓object(defined values)(props)
                // basically the value is defined like the return value.
                message2: ''
            }
        },
        // ↑ Need [ , ] divide methods

        // ↓ Run when the processes is generated
        created(){
            this.message2 = 'Count: 0'
            this.count = 0
        },

        // ↓Run (defined action to be performed when action is included)
        mounted(){
            // Interval(function, msec)
            timer = setInterval(() => {
                this.count++,
                this.message2 = 'Count: ' + this.count
            }, 1000)
        },
    }
}

</script>
