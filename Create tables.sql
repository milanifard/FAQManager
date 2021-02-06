drop table if exists faqs;
create table faqs
(
	id int auto_increment,
	constraint faqs_pk
		primary key (id),
	title text not null,
	answer text	not null,
	click_count smallint not null default 0
);

drop table if exists user_groups;
create table user_groups(
    id int auto_increment,
	constraint user_groups_pk
		primary key (id),
	title text not null,
	persian_title text not null
);
insert into user_groups (title, persian_title)
values ('STUDENT', 'دانشجو');
insert into user_groups (title, persian_title)
values ('STAFF', 'کارمند');
insert into user_groups (title, persian_title)
values ('PROF', 'پرفسور');
insert into user_groups (title, persian_title)
values ('OTHER', 'سایر');

drop table if exists faq_user_groups;
create table faq_user_groups(
    id int auto_increment,
    constraint faq_user_groups_pk
        primary key (id),
    faq_id int not null,
    constraint faq_user_groups_faq_fk foreign key (faq_id)
        references faqs (id),
    user_group_id int not null,
    constraint faq_user_groups_user_group_fk foreign key (user_group_id)
        references user_groups (id),
    constraint faq_user_groups_uq unique (faq_id, user_group_id)
);

drop table if exists keywords;
create table keywords(
    id int auto_increment,
    constraint keywords_pk
        primary key (id),
    term text
);

drop table if exists faqs_keywords;
create table faqs_keywords(
    id int auto_increment,
    constraint faqs_keywords_pk
        primary key (id),
    faq_id int not null,
    constraint faqs_keywords_faq_fk foreign key (faq_id)
        references faqs (id),
    keyword_id int not null,
    constraint faqs_keywords_keyword_fk foreign key (keyword_id)
        references keywords (id),
    constraint faqs_keywords_uq unique (faq_id, keyword_id),
    state smallint not null default 0 -- 0: pending, 1:accepted, 2:rejected
);

drop table if exists pages;
create table pages(
    id int auto_increment,
    constraint pages_pk
        primary key (id),
    title text not null,
    url text not null
);

drop table if exists faq_pages;
create table faq_pages(
    id int auto_increment,
    constraint faq_pages_pk
        primary key (id),
    faq_id int not null,
    constraint faq_pages_faq_fk foreign key (faq_id)
        references faqs (id),
    page_id int not null,
    constraint faq_pages_page_fk foreign key (page_id)
        references pages (id),
    constraint faq_pages_uq unique (page_id, faq_id)
);

drop table if exists tickets;
create table tickets(
    id int auto_increment,
    constraint tickets_pk
        primary key (id),
    title text not null,
    description text not null,
    project_id int,
    tkt_bug_report_page int not null,
    constraint tickets_page_fk foreign key (tkt_bug_report_page)
        references pages(id),
    creator_type int not null,
    constraint tickets_user_group_fk foreign key (creator_type)
        references user_groups(id),
    created_date timestamp not null default now()
)