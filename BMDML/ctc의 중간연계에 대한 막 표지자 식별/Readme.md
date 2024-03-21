# [학부연구생] BMDML

## 📕프로젝트 소개
- 유방암 혈액 종양 세포(CTC)에서의 중간연계 상태의 막 표지자를 식별
  
## 팀원 구성

4명

## ⭐주요 내용

- CTC 샘플 중 중간연계 상태에 있는 CTC 데이터 필터링
- 핵심 중간연계 표지자와 상관 계수 계산
- 임상적 유의성을 보장하기 위해 생존분석(Kaplan - Meier)을 수행 후 예후 예측
- 유방암의 중간연계 상태에서의 CTC 막 표지자로 식별
- 결과를 토대로 논문 작성 [Biochemistry and Biophysics Reports](https://www.sciencedirect.com/science/article/pii/S2405580824000165?via%3Dihub)
  
## 👤역할
- 전처리
  - 유전자 발현 데이터 평균화
  - 이상치 제거(Log 변환)
  - 동일한 분석을 위한 정규화(Z-Transform, Quantile Normalizaion)
- 시각화
  - 계층적 클러스터링 된 두 개의 하위 그룹의 히트맵 생성
 
    ![image](https://github.com/dbfla3831/portfolio/assets/80940143/fc22fa94-eb12-4006-b81e-5a3ba57314a9)


## 🧩결론
- 데이터가 중간연계 서명과 상피 서명으로 클러스터링됨을 확인
- 중간연게 서명 중 2개가 핵심 서명임을 확인
- CTC에서 중간연계 상태인 84개의 막표지자 후보를 확인
- 생존 분석을 통해 14개의 유의미한 막 유전자를 확인
- 막 표지자로 특성화된 2개의 유전자가 수용체임을 확인
