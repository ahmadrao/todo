<template>
    <div class="container">
        <transition name="fade" mode="out-in">
            <router-view class="page" :key="$route.path"></router-view>
        </transition>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
