drop table if exists faq_temp;
create table faq_temp(
    id int,
    slug text
);

insert into systemfacilitygroups(groupname, orderno)
values ('پرسش و پاسخ', 5);

insert into faq_temp(id, slug)
select last_insert_id(), 'facility_group';

insert into systemfacilities(FacilityName, GroupID, OrderNo, PageAddress)
select 'جستجو', faq_temp.id, 1, 'FAQManager/Search.php'
from faq_temp
where slug = 'facility_group';
insert into faq_temp(id)
select last_insert_id();

insert into systemfacilities(FacilityName, GroupID, OrderNo, PageAddress)
select 'افزودن FAQ', faq_temp.id, 2, 'FAQManager/AddFAQ.php'
from faq_temp
where slug = 'facility_group';
insert into faq_temp(id)
select last_insert_id();

insert into systemfacilities(FacilityName, GroupID, OrderNo, PageAddress)
select 'ارسال تیکت', faq_temp.id, 3, 'FAQManager/Ticketing.php'
from faq_temp
where slug = 'facility_group';
insert into faq_temp(id)
select last_insert_id();

insert into systemfacilities(FacilityName, GroupID, OrderNo, PageAddress)
select 'کلمات پیشنهادی', faq_temp.id, 4, 'FAQManager/KeywordManaging.php'
from faq_temp
where slug = 'facility_group';
insert into faq_temp(id)
select last_insert_id();

insert into userfacilities(UserID, FacilityID)
select 'omid', faq_temp.id
from faq_temp
where slug is null;

drop table faq_temp;