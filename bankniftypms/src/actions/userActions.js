import * as types from "./actionsTypes"
import submittingRequestStatus from "./submittingRequestStatusAction"
import toggleNetworkRequestStatus from "./toggleNetworkRequestStatus"
import * as API from "../utils/apiPath"
import { agent } from "../utils/agent"
import { setToaster } from "../utils/helpers"

export function ParamsDataSuccess(userParams) {
  return { type: types.LOADED_USER_PARAM_SUCCESS, userParams }
}

export function loginDataSuccess(userInfo) {
  return { type: types.LOADED_USER_INFO_SUCCESS, userInfo }
}

export function loadUserAuth(isAuth) {
  return { type: types.LOADED_USER_AUTH_SUCCESS, isAuth }
}

export function userLoginData(params) {
  return async (dispatch) => {
    dispatch(submittingRequestStatus(true))
    await agent
      .post(API.LOGIN, params)
      .then((response) => {
        setToaster(response.data.message, "#49BE00")
        dispatch(submittingRequestStatus(false))
        dispatch(loginDataSuccess(response.data.data))
        dispatch(loadUserAuth(true))
        localStorage.setItem("userToken", response.data.data.api_token)
        if (params.remember_me) {
          dispatch(ParamsDataSuccess(params))
        } else {
          dispatch(ParamsDataSuccess({}))
        }
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(submittingRequestStatus(false))
      })
  }
}

export function userRegisterData(params, push) {
  return async (dispatch) => {
    dispatch(submittingRequestStatus(true))
    await agent
      .post(API.REGISTER, params)
      .then((response) => {
        setToaster(response.data.message, "#49BE00")
        dispatch(submittingRequestStatus(false))
        dispatch(ParamsDataSuccess(params))
        push("/otp-verify")
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(submittingRequestStatus(false))
      })
  }
}

export function userLogout(push) {
  return (dispatch) => {
    dispatch(loadUserAuth(false))
    dispatch(loginDataSuccess({}))
    localStorage.removeItem("userToken")
    push("/login")
  }
}

export function resendOtp(params) {
  return async (dispatch) => {
    dispatch(toggleNetworkRequestStatus(true))
    await agent
      .post(API.SEND_OTP, params)
      .then(() => {
        dispatch(toggleNetworkRequestStatus(false))
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(toggleNetworkRequestStatus(false))
      })
  }
}

export function checkOtp(params, push) {
  return async (dispatch) => {
    dispatch(submittingRequestStatus(true))
    await agent
      .post(API.CHECK_OTP, params)
      .then((response) => {
        dispatch(submittingRequestStatus(false))
        dispatch(loginDataSuccess(response.data.data))
        dispatch(loadUserAuth(true))
        localStorage.setItem("userToken", response.data.data.api_token)
        push("/user/dashboard")
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(submittingRequestStatus(false))
      })
  }
}

export function forgotPassword(params, push) {
  return async (dispatch) => {
    dispatch(submittingRequestStatus(true))
    await agent
      .post(API.FORGOT_PASSWORD, params)
      .then((response) => {
        setToaster(response.data.message, "#49BE00")
        dispatch(submittingRequestStatus(false))
        dispatch(ParamsDataSuccess(params))
        push("/reset-password")
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(submittingRequestStatus(false))
      })
  }
}

export function resendOtpPassword(params) {
  return async (dispatch) => {
    dispatch(toggleNetworkRequestStatus(true))
    await agent
      .post(API.FORGOT_PASSWORD, params)
      .then((response) => {
        setToaster(response.data.message, "#49BE00")
        dispatch(toggleNetworkRequestStatus(false))
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(toggleNetworkRequestStatus(false))
      })
  }
}

export function resetPassword(params, push) {
  return async (dispatch) => {
    dispatch(submittingRequestStatus(true))
    await agent
      .post(API.RESET_PASSWORD, params)
      .then((response) => {
        setToaster(response.data.message, "#49BE00")
        dispatch(submittingRequestStatus(false))
        dispatch(loginDataSuccess({}))
        push("/login")
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(submittingRequestStatus(false))
      })
  }
}
