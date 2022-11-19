<template>
    <div v-for="project in data">
        <Card :project="project"></Card>
    </div>
</template>

<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Card from "@/Components/Card.vue";

const data = [
    {
        id: 1,
        title: "project 1",
        description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores at harum hic modi quam quia. " +
            "Ad aut cum doloremque eos, explicabo ipsam, laborum nihil nulla quaerat sunt tempora vel velit. Lorem ipsum " +
            "dolor sit amet, consectetur adipisicing elit. Asperiores at harum hic modi quam quia. Ad aut cum doloremque" +
            " eos, explicabo ipsam, laborum nihil nulla quaerat sunt tempora vel velit.",
        teamSize: 3
    },
    {
        id: 2,
        title: "project 2",
        description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores at harum hic modi quam quia. " +
            "Ad aut cum doloremque eos, explicabo ipsam, laborum nihil nulla quaerat sunt tempora vel velit. Lorem ipsum " +
            "dolor sit amet, consectetur adipisicing elit. Asperiores at harum hic modi quam quia. Ad aut cum doloremque" +
            " eos, explicabo ipsam, laborum nihil nulla quaerat sunt tempora vel velit.",
        teamSize: 5
    },
    {
        id: 3,
        title: "project 3",
        description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores at harum hic modi quam quia. " +
            "Ad aut cum doloremque eos, explicabo ipsam, laborum nihil nulla quaerat sunt tempora vel velit. Lorem ipsum " +
            "dolor sit amet, consectetur adipisicing elit. Asperiores at harum hic modi quam quia. Ad aut cum doloremque" +
            " eos, explicabo ipsam, laborum nihil nulla quaerat sunt tempora vel velit.",
        teamSize: 2
    },
    {
        id: 4,
        title: "project 4",
        description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores at harum hic modi quam quia. " +
            "Ad aut cum doloremque eos, explicabo ipsam, laborum nihil nulla quaerat sunt tempora vel velit. Lorem ipsum " +
            "dolor sit amet, consectetur adipisicing elit. Asperiores at harum hic modi quam quia. Ad aut cum doloremque" +
            " eos, explicabo ipsam, laborum nihil nulla quaerat sunt tempora vel velit.",
        teamSize: 3
    },
]

</script>
