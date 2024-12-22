<template>
    <div>
      <li v-if="page">
        <a :href="'/' + getFullSlug(page)">{{ page.title }}</a>

        <ul class="list-decimal" v-if="page.children && page.children.length">
          <PageViewerComponent
            v-for="child in page.children"
            :key="child.id"
            :page="setParent(child, page)"
          />
        </ul>
      </li>
    </div>
  </template>

  <script>
  export default {
    name: 'PageViewerComponent',
    props: {
      page: {
        type: Object,
        required: true
      }
    },
    methods: {
      getFullSlug(page) {
        let slug = page.slug;
        let parent = page.parent;
        while (parent) {
          slug = parent.slug + '/' + slug;
          parent = parent.parent;
        }
        return slug;
      },
      setParent(child, parent) {
        const childCopy = { ...child, parent };
        return childCopy;
      }
    },
    components: {
      PageViewerComponent: () => import('./PageViewerComponent.vue') // Ensure recursive registration
    }
  }
  </script>
