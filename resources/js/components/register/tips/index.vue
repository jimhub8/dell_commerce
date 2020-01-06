<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
            <v-btn color="primary" dark v-on="on">Dellmat webshop owners selling tips</v-btn>
        </template>
        <v-card>
            <Tip1 v-if="count == 1"></Tip1>
            <Tip2 v-if="count == 2"></Tip2>
            <Tip3 v-if="count == 3"></Tip3>
            <Tip4 v-if="count == 4"></Tip4>
            <Tip5 v-if="count == 5"></Tip5>
            <Tip6 v-if="count == 6"></Tip6>
            <Tip7 v-if="count == 7"></Tip7>
            <Tip8 v-if="count == 8"></Tip8>
            <Tip9 v-if="count == 9"></Tip9>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="count += 1" v-if="count < 9">Next</v-btn>
                <v-btn color="blue darken-1" flat @click="dialog = false" v-else>Finish</v-btn>
                <v-btn color="blue darken-1" flat @click="dialog = false">Skip</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
import Tip1 from './tip1'
import Tip2 from './tip2'
import Tip3 from './tip3'
import Tip4 from './tip4'
import Tip5 from './tip5'
import Tip6 from './tip6'
import Tip7 from './tip7'
import Tip8 from './tip8'
import Tip9 from './tip9'
export default {
    components: {
        Tip1,
        Tip2,
        Tip3,
        Tip4,
        Tip5,
        Tip6,
        Tip7,
        Tip8,
        Tip9
    },
    data() {
        return {
            count: 1,
            dialog: true,
        }
    },
}
</script>
