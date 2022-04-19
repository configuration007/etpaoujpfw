
import axios from 'axios'
import { router } from './routes'

export const axiosControl = () => {

  axios.defaults.timeout = 10000;
  axios.interceptors.request.use(
    config => {
      const token = localStorage.getItem("client_token");
      if (token) {
        config.headers.common["Authorization"] = `Bearer ${token}`;
      }
      return config;
    },
    error => {
      return Promise.reject(error);
    }
  );
  axios.interceptors.response.use(
    response => {
      if (response.status === 200 || response.status === 201) {
        return Promise.resolve(response);
      } else {
        return Promise.reject(response);
      }
    },
    error => {
      if (error.response && error.response.status) {
        switch (error.response.status) {
          case 400:
            break;

          case 401:
            router.push({ path: '/login' })
            break;
          case 403:
            router.replace({
              path: "/login",
              query: { redirect: router.currentRoute.fullPath }
            });
            break;
          case 404:
            alert('page not exist');
            break;
          case 502:
            setTimeout(() => {
              router.replace({
                path: "/login",
                query: {
                  redirect: router.currentRoute.fullPath
                }
              });
            }, 1000);
        }
        return Promise.reject(error.response);
      }
    }
  );
}
export default axiosControl();