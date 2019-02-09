<template>
  <label class="search-list-item-check">
      <div class="search-list-item-check-trigger"
           v-bind:class="{ 'is-enabled': isEnabled }">
        <i class="fa fa-check-square-o"
           v-on:click="toggle"></i>
      </div>
  </label>
</template>

<script>
  export default {
    directives: { },
    data: function() {
      return {
        allEnabled() {
          return Array
            .from(this.checkboxesEl, checkbox => {
              return checkbox.checked
            })
            .every(checked => checked === true)
        },
        isEnabled: false,
        checkboxesEl: [],
        parentEl: {}
      }
    },
    props: ['identifier', 'parent'],
    mounted() {
      this.checkboxesEl
        = document.querySelectorAll(this.identifier)
      this.parentEl
        = document.querySelector(this.parent)

      this.parentEl
        .addEventListener('click', (event) => {
          if (event.target.closest(this.identifier)) {
            this.isEnabled = this.allEnabled()
          }
        })
    },
    methods: {
      enable() {
        this.isEnabled = true
        this.checkboxesEl
          .forEach(checkbox => checkbox.checked = true)
      },
      disable() {
        this.isEnabled = false
        this.checkboxesEl
          .forEach(checkbox => checkbox.checked = false)
      },
      toggle() {
        this.allEnabled()
          ? this.disable()
          : this.enable()
      }
    }
  }
</script>

<!--  styles can be found in resources/assets/sass/_components.search.scss -->