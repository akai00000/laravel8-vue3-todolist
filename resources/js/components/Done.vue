<template>
    <!-- <div class="row justify-content-center"> -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" v-for="col in cols" v-bind:key="col.id">
                        {{ col }}
                    </th>
                    <th>
                        status
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="todo in todos" v-bind:key="todo.id">
                <th scope="row">{{ todo.id }}</th>
                <td>{{ todo.title }}</td>
                <td>{{ todo.rabel }}</td>
                <td>{{ todo.content }}</td>
                <td>{{ todo.priority }}</td>
                <td>{{ todo.deadline }}</td>
                <td>{{ todo.created_at }}</td>
                <td><button v-on:click="recovery(todo.id)">元に戻す</button></td>
                </tr>
            </tbody>
        </table>
    <!-- </div> -->
</template>
    
    <script>
    let url = "http://localhost:8000/done"
    
    export default {
        data() {
        return {
            cols: "", //columns.value(arr)
            todos: "",
        };
        },
        created() {
        this.colsGet();
        },
        methods: {
        async colsGet() {
            const res_colsGet = await axios.get("/done_axios");
            this.cols = res_colsGet.data[0];
            this.todos = res_colsGet.data[1];
        },
        async recovery(id) {
            console.log('test');
            await axios.post("/done_axios_post", id);
        },
        }
    };
    </script>