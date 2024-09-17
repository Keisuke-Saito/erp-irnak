export const SPOUSE = { false: '未婚', true: '既婚' }
export const ENDUCATIONAL_BACKGROUND = { 1: '大学院', 2: '大学', 3: '短大', 4: '専門', 5: '高校', 6: '中学' }
export const RECRUITMENT_CLASSIFICATION = { 1: '新卒', 2: '中途', 99: 'その他' }
export const CLASSIFICATION_OF_ATTENDANCE = { 0: '未採用', 1: '在職', 2: '休職', 3: '退職' }
export const PROFILE_COLUMNS = ['スタッフコード', '名前', '名前（カナ）', '誕生日', '性別', '郵便番号', '住所', '最寄駅', '出身地', '結婚', '最終学歴', 'アドレス', '連絡先', '緊急連絡先', '所持資格', '採用区分', '在籍区分', '所属', '所属部門', '役職', '入社年月日', '退職年月日 ', '従業員区分', '業務区分', '稼働先名称', '稼働先', '業務内容', 'メモ', 'ログイン制御']
export const GENDER = { 1: '不明', 2: '男性', 3: '女性', 99: 'その他' }
export const LOGIN_DIV_LIST = { null: '未登録', false: 'ログイン不可', true: 'ログイン可' }
export const GENDER_SELECT = [
  { key: 0, value: 1, label: '不明' },
  { key: 1, value: 2, label: '男性' },
  { key: 2, value: 3, label: '女性' },
  { key: 3, value: 99, label: 'その他' }
]
export const SPOUSE_SELECT = [
  { key: 0, value: '', label: '不明' },
  { key: 1, value: 0, label: 'なし' },
  { key: 2, value: 1, label: 'あり' }
]
export const ENDUCATIONAL_BACKGROUND_SELECT = [
  { key: 0, value: '', label: '不明' },
  { key: 1, value: 1, label: '大学院' },
  { key: 2, value: 2, label: '大学' },
  { key: 3, value: 3, label: '短大' },
  { key: 4, value: 4, label: '専門' },
  { key: 5, value: 5, label: '高校' },
  { key: 6, value: 6, label: '中学' }
]
export const RECRUITMENT_CLASSIFICATION_SELECT = [
  { key: 0, value: 1, label: '新卒' },
  { key: 1, value: 2, label: '中途' },
  { key: 2, value: 99, label: 'その他' }
]
export const PROFILE_SORT_SELECT = [
  { value: 'erpId', label: 'スタッフコード' },
  { value: 'kana', label: '名前（カナ）' },
  { value: 'joinedAt', label: '入社年月日' }
]
export const ORDER_BY_SELECT = [
  { value: 'asc', label: '昇順' },
  { value: 'desc', label: '降順' }
]
