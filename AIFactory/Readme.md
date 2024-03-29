# [공모전] 수돗물 수요 예측 AI 모델 구축

## 📕프로젝트 소개
- 수요 변화에 따라 달라지는 배수지 유령 적산차(시간 단위 공급량)예측하는 AI 모델 구축

## ⏰기간
2022.11 ~ 2022.12

## 👥 팀원 구성

4명

## ⭐주요 내용
- 상업 별 2021년 1월부터 12월까지 시간 당 유량 적산차 예측
- 결과값에 따라 가장 낮은 mse 값 도출

## 👤역할

- 전처리
    - 이상치 제거(사분위수)
    - 균등한 분포를 위해 정규화(RobustScaler)
- 모델링
    - 모델 구축(Keras의 Sequential, Convolution, Sklearn의 Linear Regression)
    - 낮은 mse를 위해 layer, Optimizers, epochs, batch_size를 조정

## 🧩결론

- 다양한 데이터 전처리 기술 적용
- 모델 구축 및 최적화
- 성능 평가와 향상
- 결과에 대한 지속적인 학습과 개선
