<template>
    <div class="main">
        <Navbar />
        <slot></slot>
    </div>
</template>

<script>
import Navbar from "../components/Navbar";
export default { components: { Navbar } };
</script>

<style>
.main{
    width: 80%;
    margin: 0 auto;
}
</style>