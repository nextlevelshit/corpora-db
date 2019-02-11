<template>

    <label class="autocomplete">
        {{ title }}

        <input type="hidden"
               v-model="selectedString"
               v-bind:name="name">

        <div class="autocomplete-input" v-bind:class="{ '--focused': isFocused }">
            <span class="autocomplete-input-tag" 
            v-for="(item, index) in selected" :key="index"
            v-on:click="remove(index)">{{ item.name }}</span>
            <input type="text" class="autocomplete-input-inner" autocomplete="off"
               v-model="term"
               v-focus="isFocused"
               v-bind:placeholder="placeholder"
               v-on:focus="focusInput()"
               v-on:blur="blurInput($event)"
               v-on:keyup="triggerAutocomplete()"
               v-on:keydown.enter="addToSelected($event)"
               v-on:keydown.delete="removeLastFromSelected()">
        </div>

        <ul class="autocomplete-list"
            v-bind:class="{ 'active': suggestions.length }">

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
                selectedString: this.value ? this.value : '',
                selected: this.value ? JSON.parse(this.value) : [],
                suggestions: [],
                newId: this.id,
                term: '',
                isFocused: false,
                isHovered: false
            }
        },
        props: ['title', 'name', 'table', 'placeholder', 'id', 'value', 'api'],
        methods: {
            triggerAutocomplete: function(event) {
                // this.newId = null;
                // Trim Search Term and remove leading Spaces and Comma. 
                var searchTerm = this.term.substring(this.term.lastIndexOf(',') + 1).trim();
                // Do not perform Search if Search Term is to short
                if (searchTerm.length < 3) return;

                var url = `${this.api}/${this.table}/${searchTerm}`;

                this.$http.get(url).then(function(response) {
                    this.suggestions = response.body;
                });
            },

            resetAutocomplete: function() {
                this.term = '';
                this.suggestions = [];
            },

            selectFromAutocomplete: function(item) {
                this.selected.push(item);
                this.updateSelectedString();
                this.resetAutocomplete();
            },

            addToSelected: function(event) {
                event.preventDefault();

                if(this.term.length === 0) return;

                this.selected.push({
                    name: this.term
                });
                this.updateSelectedString();
                this.resetAutocomplete();
            },

            updateSelectedString: function() {
                this.selectedString = JSON.stringify(this.selected);
            },

            removeLastFromSelected: function() {
                if(this.term.length > 0) return;
            
                this.selected.pop();
                this.updateSelectedString();
            },

            remove: function(index) {
                this.selected.splice(index, 1);
                this.updateSelectedString();
            },

            focusInput: function() {
                this.isFocused = true;
            },

            blurInput: function(event) {
                this.isFocused = false;
                if (this.suggestions.length === 0) {
                    console.log(event);
                    this.addToSelected(event);
                    this.updateSelectedString();
                } 
            }

         }
    }
</script>

<!--  styles can be found in resources/assets/sass/_components.autocomplete.scss -->
