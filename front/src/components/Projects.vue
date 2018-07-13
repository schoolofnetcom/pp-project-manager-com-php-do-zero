<template>
    <div>
        <h1 class="red">{{ mensagem }}</h1>
        <p>Projeto prático da SON</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            mensagem: 'Olá Erik'
        }
    },
    mounted() {
        console.log('estamos prontos para trabalhar');
    }
}
</script>

<style>
    .red {
        background-color: red;
        color: white;
    }
</style>

