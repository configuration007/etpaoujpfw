import Vue from "vue";
import Gate from "./gate";
import { routes } from "./routes";
import VueRouter from "vue-router";
import { userData } from "./userData"
import VueProgressBar from 'vue-progressbar'
var aP = new Vue();
const options = {
    color: '#C98144',
    failedColor: '#874b4b',
    thickness: '2px',
    transition: { speed: '1s', opacity: '0.6s', termination: 300 },
    autoRevert: true,
    location: 'top',
    inverse: false
}
// var expiry = localStorage.getItem("expiry_time");
// if(expiry != null){
//     var ts = (Math.round(new Date().getTime() / 1000));
//     if(ts > expiry){
//         window.location = ''
//     }
// }



Vue.use(VueProgressBar, options)
export const router = new VueRouter({
    routes,
    mode: "history"
});
router.beforeEach((to, from, next) => {
    aP.$Progress.start()
    var isPath = to.path;
    var isAdmin = isPath.includes("admin");
    var isOperator = isPath.includes("operator");
    var isAgent = isPath.includes("agent");
    var isDeveloper = isPath.includes("developer");
    var isLoginRoute = isPath.includes("login");
   
    if ((isAdmin || isOperator || isAgent || isDeveloper)) {
        var user_type = userData("user_type");
        var loggedInUser = userData('is_logged_in');    
        if (loggedInUser == null || !loggedInUser) {
            var locationa = window.location.href 
            if(locationa.includes("login")){
                router.push( {path :"/login"});       
            }else{
            router.push( {path :"/login", query:{ plan:window.location.href }});
            }
        } else {
            if (user_type == "") {
                router.push("/oops");
            } else {
                if (isAdmin && user_type == "admin") {

                    Vue.prototype.$gate = Vue.observable(new Gate());
                    
                    //check for admin users
                    next();
                } else if (isOperator && user_type == "operator") {
                    //check for operator users
                    next();
                } else if (isAgent && user_type == "agent") {
                    //check for agent users
                    next();

                } else if ((isDeveloper || isAdmin) && user_type == "developer") {
                    Vue.prototype.$gate = Vue.observable(new Gate());
                    //check for developer users
                    next();
                }
                else {
                    router.push("/unauthorized");
                }
            }
        }
    } else {
        next();
    }
});
router.afterEach(() => {
    aP.$Progress.finish()
}) 