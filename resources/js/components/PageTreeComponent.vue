<template>
    <div>
        <h1>Page Viewer Tree</h1>
        <ul class="list-decimal">
            <PageViewerComponent
                v-for="page in pages"
                :key="page.id"
                :page="page"
            />
        </ul>
    </div>
</template>

<script>
import PageViewerComponent from './PageViewerComponent.vue';
import axios from 'axios';

export default {
    name: 'PageTreeComponent',
    components: {
        PageViewerComponent
    },
    data() {
        return {
            pages: []
        };
    },
    created() {
        axios.get('/pages')
            .then(response => {
                // console.log('Fetched pages:', response.data); // Debugging line
                this.pages = response.data;
            })
            .catch(error => {
                console.error('Error fetching page tree:', error);
            });
    }
}
</script>
