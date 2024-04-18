<script>
export default {
    name: "SearchBar",

    emits: ["connections_search"],

    data() {
        return {
            searchQuery: '',
            connections: '',
        }
    },

    methods: {
        search(){
            // axios.get('/api/search', { params: { query: this.searchQuery }})
            //     .then(response => {
            //         //connections.value = response.data.data;
            //         this.$emit('connections_search', {
            //             connections: response.data.data,
            //         })
            //     })
            this.$emit('connections_search', {
                connections: this.searchQuery,
            })
        }
    }
}
</script>

<template>
    <div class="search-form mb-3">
        <input type="search" v-model="searchQuery" placeholder="Search" class="search-input">
        <button @click="search" type="submit" class="search-button">
            <svg class="submit-button">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search"></use>
            </svg>
        </button>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" display="none">
        <symbol id="search" viewBox="0 0 32 32">
            <path d="M 19.5 3 C 14.26514 3 10 7.2651394 10 12.5 C 10 14.749977 10.810825 16.807458 12.125 18.4375 L 3.28125 27.28125 L 4.71875 28.71875 L 13.5625 19.875 C 15.192542 21.189175 17.250023 22 19.5 22 C 24.73486 22 29 17.73486 29 12.5 C 29 7.2651394 24.73486 3 19.5 3 z M 19.5 5 C 23.65398 5 27 8.3460198 27 12.5 C 27 16.65398 23.65398 20 19.5 20 C 15.34602 20 12 16.65398 12 12.5 C 12 8.3460198 15.34602 5 19.5 5 z" />
        </symbol>
    </svg>
</template>

<style scoped>
.search-form {
    position: relative;
    left: 0;
    width: 350px;
    height: 40px;
    border-radius: 40px;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    background: #fff;
    transition: all 0.3s ease;

    &.focus {
        box-shadow: 0 3px 4px rgba(0, 0, 0, 0.15);
    }
}

.search-input {
    position: absolute;
    top: 10px;
    left: 38px;
    font-size: 14px;
    background: none;
    color: #5a6674;
    width: 290px;
    height: 20px;
    border: none;
    appearance: none;
    outline: none;

    &::-webkit-search-cancel-button {
        appearance: none;
    }
}

.search-button {
    position: absolute;
    top: 7px;
    left: 15px;
    height: 20px;
    width: 20px;
    padding: 0;
    margin: 0;
    border: none;
    background: none;
    outline: none!important;
    cursor: pointer;

    & svg {
        width: 20px;
        height: 20px;
        fill: #5a6674;
    }
}

.search-option {
    position: absolute;
    text-align: right;
    top: 10px;
    right: 15px;

    div {
        position: relative;
        display: inline-block;
        margin: 0 1px;
        cursor: pointer;

        input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0.01;
            cursor: pointer;
        }

        span {
            position: absolute;
            display: block;
            text-align: center;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            background: #929AA3;
            color: #fff;
            font-size: 9px;
            letter-spacing: 1px;
            line-height: 1;
            text-transform: uppercase;
            padding: 4px 7px;
            border-radius: 12px;
            top: -18px;
            transition: all .2s ease-in-out;

            &::after {
                content: '';
                position: absolute;
                bottom: -3px;
                left: 50%;
                transform: translateX(-50%);
                border-top: 4px solid #929AA3;
                border-left: 4px solid transparent;
                border-right: 4px solid transparent;
                transition: all .2s ease-in-out;
            }
        }

        &:hover span {
            opacity: 1;
            top: -21px;
        }

        label {
            display: block;
            cursor: pointer;
        }

        svg {
            height: 20px;
            width: 20px;
            fill: #5a6674;
            opacity: 0.6;
            transition: all .2s ease-in-out;
            pointer-events: none;
        }

        &:hover svg {
            opacity: 1;
        }

        input:checked + label svg {
            fill: $color;
            opacity: .9;
        }

        input:checked + label span {
            background: $color;

            &::after {
                border-top-color: $color;
            }
        }
    }
}
</style>
