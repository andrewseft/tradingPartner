import axios from "axios"
const { REACT_APP_API_BASE_URL } = process.env
const agent = axios.create({
  baseURL: REACT_APP_API_BASE_URL,
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
})

agent.interceptors.request.use((config) => {
  const token = localStorage.getItem("authTokenApp")
  if (!token) {
    return config
  }

  if (process.browser) {
    config = {
      ...config,
      headers: { ...config.headers, Authorization: `Bearer ${token}` },
    }
  }

  return config
})

agent.interceptors.response.use(
  function (response) {
    return response
  },
  function (error) {
    if (error.response.data.message === "Unauthenticated.") {
      localStorage.removeItem("persist:root")
      window.location.href = "/"
    }
    return Promise.reject(error.response.data)
  }
)

export { agent }
