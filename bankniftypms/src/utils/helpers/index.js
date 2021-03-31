import { check, toast } from "react-interaction"

export const setToaster = (value, color = "#f20b0bf5") => {
  toast(value ? value : "Sorry we are facing some technical issues!", {
    time: 5000,
    style: {
      borderRadius: 5,
      backgroundColor: color,
      color: "#fff",
    },
  })
}

export const checkConform = async (callback, message) => {
  try {
    const isConfirmed = await check(message, {
      okStyle: {
        backgroundColor: "#0078ff",
        color: "#fff",
      },
      contentClassName: "account-logout",
      contentStyle: {
        width: 600,
      },
      okText: "Yes",
      cancelClassName: "my-check-cancel",
      cancelStyle: {
        backgroundColor: "#ccc",
        color: "#fff",
      },
      cancelText: "No",
    })

    if (isConfirmed) {
      callback()
    }
  } catch (error) {
    console.log(error.message)
  }
}

export const renderTitle = (title) => {
  if (!title) {
    return ""
  } else {
    var str = title
    var n = str.length
    if (n === 0) {
      return ""
    } else {
      var res = str.slice(0, 30)
      var dot = ""
      if (n > 30) {
        dot = "..."
      }
      return res + dot
    }
  }
}

export const catchError = (response) => {
  if (response instanceof Error) {
    throw new Error(response.response.data.message)
  }
}
