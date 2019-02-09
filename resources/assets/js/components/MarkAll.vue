<template>
  <label class="search-list-item-check">
    <input type="checkbox" 
           class="search-list-item-check-input" 
           name="markAllEntries">
      <div class="search-list-item-check-trigger">
        <i class="fa fa-check-square-o"></i>
      </div>
  </label>
</template>

<script>
  export default {
    mounted() {
      console.log('MarkAll mounted.')
    },
    directives: { },
    data: function() {
      return {
        isEnabled: false
      }
    },
    props: ['identfier'],
    methods: {
      enable: function() {
        console.log('is enabling');
      },
      disable: function() {
        console.log('is disabling');
      }
    }
  }
</script>
