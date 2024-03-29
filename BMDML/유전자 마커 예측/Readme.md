# [학부연구생] BMDML

## 📕프로젝트 소개

- 유방암의 전이 종류를 분류하는 유전자 마커 예측

## ⏰기간

2022.03 ~ 2023.05

## 👥 팀원 구성

2명

## ⭐주요 내용

- 암 전이 종류(원발암, 순환암, 전이암)에 대한 유전자 발현 데이터 수집 및 처리

- 암 전이 종류를 분류하는 앙상블 머신러닝 모델 구축

- 성능의 유의미한 유전자 분석

## 👤역할

![image](https://github.com/dbfla3831/portfolio/assets/80940143/86103296-ce3e-4530-99c8-aeb3f4a68cab)


- 전처리

  - 각 데이터 정규화 (StandardScaler)
  - 세 개의 데이터에서 중복되는 gene별로 병합
  - 균등한 분포를 위한 2차 정규화 (Quantile Normalizaion)
  - 모델 성능을 높이기 위한 차원 축소 (PCA)

- 모델링

  - 앙상블 모델 (Random Forest, AdaBoost, XGBoost)구축
 
  - ![image](https://github.com/dbfla3831/portfolio/assets/80940143/b177ab6b-cab2-4234-8527-df6972de4382)


## 🧩결론

![image](https://github.com/dbfla3831/portfolio/assets/80940143/763f49f5-4ed3-4728-bd9d-dbeb10710c39)


- TOP 10 중 하나는 유방암 발생, 전이에 큰 역할인 유전자임을 확인

- 또 다른 하나는 유방암 치료에 주요한 유전자임을 확인
