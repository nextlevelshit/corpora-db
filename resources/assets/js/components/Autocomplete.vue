<template>

    <label class="autocomplete">
        {{ title }}
        <input type="hidden"
               v-model="selected"
               v-bind:name="name">

        <div class="autocomplete-input" v-bind:class="{ '--focused': isFocused }">
            <span class="autocomplete-input-tag" 
            v-for="(item, index) in selected" :key="index"
            v-on:click="remove(index)">{{ item.name }}</span>
            <input type="text" class="autocomplete-input-inner" autocomplete="off"
               v-model="term"
               v-focus="isFocused"
               v-bind:placeholder="placeholder"
               @focus="focusInput()"
               @blur="blurInput($event)"
               v-on:mouseover="isHover = true"
               v-on:mouseout="isHover = false"
               v-on:keyup="triggerAutocomplete()"
               v-on:keydown.enter="addToSelected($event)"
               v-on:keydown.delete="removeLastFromSelected()">
        </div>

        <ul class="autocomplete-list"
            v-bind:class="{ 'active': suggestions.length }"
                v-on:hover="isHovered">

            <li class="autocomplete-list-item"
                v-for="item in suggestions" :key="item.id"
                v-on:click="selectFromAutocomplete(item)">
                {{ item.name }} <sup>[{{ item.id }}]</sup>
            </li>
        </ul>

        <div class="autocomplete-backdrop"
             v-if="suggestions.length"
             v-on:click="resetAutocomplete"></div>

    </label>
</template>


<script>
    export default {
        directives: { focus: focus },
        data: function() {
            return {
                selected: this.value ? JSON.parse(this.value) : [],
                suggestions: [],
                newId: this.id,
                term: '',
                isFocused: false,
                isHovered: true
            }
        },
        props: ['title', 'name', 'table', 'placeholder', 'id', 'value', 'api'],
        methods: {
            triggerAutocomplete: function(event) {
                // this.newId = null;
                // Trim Search Term and remove leading Spaces and Comma. 
                var searchTerm = this.term.substring(this.term.lastIndexOf(',') + 1).trim();
                // Do not perform Search if Search Term is empty
                if (searchTerm.length === 0) return;

                var url = `${this.api}/${this.table}/${searchTerm}`;

                this.$http.get(url).then(function(response) {
                    this.suggestions = response.body[0];
                });
            },

            resetAutocomplete: function() {
                this.term = '';
                this.suggestions = [];
            },

            selectFromAutocomplete: function(item) {
                this.selected.push(item);
                this.resetAutocomplete();
            },

            addToSelected: function(event) {
                event.preventDefault();

                if(this.term.length === 0) return;

                this.selected.push({
                    name: this.term
                });
                this.resetAutocomplete();
            },

            removeLastFromSelected: function() {
                if(this.term.length > 0) return;
            
                this.selected.pop();
            },

            remove: function(index) {
                this.selected.splice(index, 1);
            },

            focusInput: function() {
                this.isFocused = true;
            },

            blurInput: function(event) {
                this.isFocused = false;
                if (!this.isHoverd) this.addToSelected(event);
            }

         }
    }
</script>

<!--  styles can be found in resources/assets/sass/_components.autocomplete.scss -->
