import * as types from "./actionsTypes"
import { agent } from "../utils/agent"
import * as API from "../utils/apiPath"
import toggleNetworkRequestStatus from "./toggleNetworkRequestStatus"
import { setToaster } from "../utils/helpers"
import { getPassbookData } from "./planActions"

export function loadWalletAmountDataSuccess(walletAmount) {
  return { type: types.WALLET_SUCCESS, walletAmount }
}

export const getPlanData = () => async (dispatch) => {
  try {
    const response = await agent.get(API.GET_WALLET_AMOUNT)
    dispatch(loadWalletAmountDataSuccess(response.data.data))
  } catch (error) {}
}

export function addAmountWallet(params) {
  return async (dispatch) => {
    dispatch(toggleNetworkRequestStatus(true))
    await agent
      .post(API.ADD_AMOUNT_WALLET, params)
      .then((response) => {
        setToaster(response.data.message, "#49BE00")
        dispatch(toggleNetworkRequestStatus(false))
        dispatch(loadWalletAmountDataSuccess(response.data.data))
        dispatch(getPassbookData())
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(toggleNetworkRequestStatus(false))
      })
  }
}

export function requestForWithdrawal(params) {
  return async (dispatch) => {
    dispatch(toggleNetworkRequestStatus(true))
    await agent
      .post(API.WITHDRAWAL_REQUEST, params)
      .then((response) => {
        setToaster(response.data.message, "#49BE00")
        dispatch(toggleNetworkRequestStatus(false))
        dispatch(loadWalletAmountDataSuccess(response.data.data))
        dispatch(getPassbookData())
      })
      .catch((error) => {
        setToaster(error.message)
        dispatch(toggleNetworkRequestStatus(false))
      })
  }
}
